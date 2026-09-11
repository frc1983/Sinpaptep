<?php

namespace common\services;

use RuntimeException;
use Yii;

/**
 * Synchronizes the union's own Instagram media and exposes a safe local cache.
 * The public home page never calls Meta directly.
 */
class InstagramFeedService
{
    private const DEFAULT_API_VERSION = 'v24.0';
    private const PROFILE_URL = 'https://www.instagram.com/sindicato_publirs/';

    public function getCachedFeed(): array
    {
        $data = $this->readJson($this->feedPath());

        return [
            'username' => 'sindicato_publirs',
            'profile_url' => self::PROFILE_URL,
            'posts' => isset($data['posts']) && is_array($data['posts']) ? $data['posts'] : [],
            'synced_at' => $data['synced_at'] ?? null,
        ];
    }

    public function sync(int $limit = 6): array
    {
        $userId = trim((string) getenv('INSTAGRAM_USER_ID'));
        $token = $this->accessToken();
        if ($userId === '' || $token === '') {
            throw new RuntimeException('Configure INSTAGRAM_USER_ID e INSTAGRAM_ACCESS_TOKEN no arquivo .env.');
        }

        $version = trim((string) getenv('INSTAGRAM_API_VERSION')) ?: self::DEFAULT_API_VERSION;
        $fields = 'id,caption,media_type,media_url,thumbnail_url,permalink,timestamp';
        $url = sprintf(
            'https://graph.instagram.com/%s/%s/media?fields=%s&limit=%d&access_token=%s',
            rawurlencode($version),
            rawurlencode($userId),
            rawurlencode($fields),
            max(1, min($limit, 12)),
            rawurlencode($token)
        );

        $response = $this->requestJson($url);
        $posts = [];
        foreach ($response['data'] ?? [] as $item) {
            $post = $this->normalizePost($item);
            if ($post !== null) {
                $posts[] = $post;
            }
        }

        $feed = [
            'username' => 'sindicato_publirs',
            'profile_url' => self::PROFILE_URL,
            'posts' => $posts,
            'synced_at' => gmdate('c'),
        ];
        $this->writeJson($this->feedPath(), $feed);

        return $feed;
    }

    public function refreshAccessToken(): array
    {
        $token = $this->accessToken();
        if ($token === '') {
            throw new RuntimeException('Configure INSTAGRAM_ACCESS_TOKEN no arquivo .env.');
        }

        $url = 'https://graph.instagram.com/refresh_access_token?grant_type=ig_refresh_token&access_token=' . rawurlencode($token);
        $response = $this->requestJson($url);
        if (empty($response['access_token'])) {
            throw new RuntimeException('A Meta não retornou um novo token de acesso.');
        }

        $tokenData = [
            'access_token' => (string) $response['access_token'],
            'expires_at' => time() + (int) ($response['expires_in'] ?? 0),
            'refreshed_at' => gmdate('c'),
        ];
        $this->writeJson($this->tokenPath(), $tokenData);

        return $tokenData;
    }

    private function normalizePost(array $item): ?array
    {
        $permalink = filter_var($item['permalink'] ?? '', FILTER_VALIDATE_URL);
        $mediaType = (string) ($item['media_type'] ?? 'IMAGE');
        $imageUrl = $mediaType === 'VIDEO'
            ? ($item['thumbnail_url'] ?? '')
            : ($item['media_url'] ?? '');
        $imageUrl = filter_var($imageUrl, FILTER_VALIDATE_URL);

        if (!$permalink || !$imageUrl || stripos((string) $permalink, 'https://www.instagram.com/') !== 0) {
            return null;
        }

        return [
            'id' => (string) ($item['id'] ?? ''),
            'caption' => trim((string) ($item['caption'] ?? '')),
            'media_type' => $mediaType,
            'image_url' => (string) $imageUrl,
            'permalink' => (string) $permalink,
            'timestamp' => (string) ($item['timestamp'] ?? ''),
        ];
    }

    private function accessToken(): string
    {
        $cached = $this->readJson($this->tokenPath());
        if (!empty($cached['access_token'])) {
            return (string) $cached['access_token'];
        }

        return trim((string) getenv('INSTAGRAM_ACCESS_TOKEN'));
    }

    private function requestJson(string $url): array
    {
        if (!function_exists('curl_init')) {
            throw new RuntimeException('A extensão cURL do PHP é necessária para consultar a Meta.');
        }

        $curl = curl_init($url);
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CONNECTTIMEOUT => 10,
            CURLOPT_TIMEOUT => 25,
            CURLOPT_HTTPHEADER => ['Accept: application/json'],
        ]);
        $body = curl_exec($curl);
        $status = (int) curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $error = curl_error($curl);
        curl_close($curl);

        if ($body === false || $status < 200 || $status >= 300) {
            throw new RuntimeException('Falha ao consultar a Meta' . ($error ? ': ' . $error : ' (HTTP ' . $status . ').'));
        }

        $data = json_decode($body, true);
        if (!is_array($data)) {
            throw new RuntimeException('A Meta retornou uma resposta inválida.');
        }
        if (!empty($data['error']['message'])) {
            throw new RuntimeException('A Meta recusou a consulta: ' . $data['error']['message']);
        }

        return $data;
    }

    private function readJson(string $path): array
    {
        if (!is_readable($path)) {
            return [];
        }

        $data = json_decode((string) file_get_contents($path), true);
        return is_array($data) ? $data : [];
    }

    private function writeJson(string $path, array $data): void
    {
        $directory = dirname($path);
        if (!is_dir($directory) && !mkdir($directory, 0775, true) && !is_dir($directory)) {
            throw new RuntimeException('Não foi possível criar o diretório de cache do Instagram.');
        }

        $json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        if ($json === false || file_put_contents($path, $json, LOCK_EX) === false) {
            throw new RuntimeException('Não foi possível salvar o cache do Instagram.');
        }
    }

    private function feedPath(): string
    {
        return Yii::getAlias('@frontend/runtime/instagram-feed.json');
    }

    private function tokenPath(): string
    {
        return Yii::getAlias('@frontend/runtime/instagram-token.json');
    }
}
