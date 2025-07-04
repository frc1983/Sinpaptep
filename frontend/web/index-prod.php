<?php

// Configurações específicas para produção na Locaweb
defined('YII_DEBUG') or define('YII_DEBUG', false);
defined('YII_ENV') or define('YII_ENV', 'prod');

// Verifica se o autoload existe
if (!file_exists(__DIR__ . '/../../vendor/autoload.php')) {
    die('Vendor autoload não encontrado. Execute: composer install');
}

require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../../vendor/yiisoft/yii2/Yii.php';

// Verifica se os arquivos de bootstrap existem
if (file_exists(__DIR__ . '/../../common/config/bootstrap.php')) {
    require __DIR__ . '/../../common/config/bootstrap.php';
}
if (file_exists(__DIR__ . '/../config/bootstrap.php')) {
    require __DIR__ . '/../config/bootstrap.php';
}

// Configuração para produção
$config = yii\helpers\ArrayHelper::merge(
    require __DIR__ . '/../../common/config/main.php',
    require __DIR__ . '/../config/main.php'
);

// Adiciona configurações específicas para produção
$config['components']['log']['targets'][0]['levels'] = ['error']; // Apenas erros
$config['components']['cache']['class'] = 'yii\caching\FileCache';

// Remove debug e gii se existirem
unset($config['bootstrap']['debug']);
unset($config['modules']['debug']);
unset($config['bootstrap']['gii']);
unset($config['modules']['gii']);

(new yii\web\Application($config))->run(); 