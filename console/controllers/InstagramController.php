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
        $this->stderr("O Token de Página deve ser renovado no Meta e atualizado em INSTAGRAM_ACCESS_TOKEN.\n");
        return ExitCode::UNSPECIFIED_ERROR;
    }
}
