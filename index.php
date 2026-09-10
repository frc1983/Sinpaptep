<?php

/**
 * Public entry point for hosts whose document root is public_html.
 * The frontend Yii application lives in frontend/web.
 */
defined('YII_DEBUG') or define('YII_DEBUG', false);
defined('YII_ENV') or define('YII_ENV', 'prod');

require __DIR__ . '/frontend/web/index.php';
