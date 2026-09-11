<?php

namespace console\controllers;

use common\services\InstagramFeedService;
use Throwable;
use yii\console\Controller;
use yii\console\ExitCode;

class InstagramController extends Controller
{
    public function actionSync(): int
    {
        try {
            $feed = (new InstagramFeedService())->sync(6);
            $this->stdout(count($feed['posts']) . " publicações sincronizadas.\n");
            return ExitCode::OK;
        } catch (Throwable $exception) {
            $this->stderr($exception->getMessage() . "\n");
            return ExitCode::UNSPECIFIED_ERROR;
        }
    }

    public function actionRefreshToken(): int
    {
        try {
            $data = (new InstagramFeedService())->refreshAccessToken();
            $expiresAt = !empty($data['expires_at']) ? date('d/m/Y H:i', (int) $data['expires_at']) : 'não informado';
            $this->stdout("Token renovado e armazenado com segurança. Validade: {$expiresAt}.\n");
            return ExitCode::OK;
        } catch (Throwable $exception) {
            $this->stderr($exception->getMessage() . "\n");
            return ExitCode::UNSPECIFIED_ERROR;
        }
    }
}
