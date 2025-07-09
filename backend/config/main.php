<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'name' => 'SINPAPTEP-RS',
    'language' => 'pt-BR',
    'basePath' => dirname(__DIR__),
    'charset' => 'utf-8',
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
            'cookieValidationKey' => 'Qw8z2nV7pLk4sT1xRj6bYc9uHf3eGm5aSd0Xv2WqZt7Jr8PlB',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning', 'info'],
                    'logVars' => ['_GET', '_POST', '_FILES', '_COOKIE', '_SESSION', '_SERVER'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => false,
            'showScriptName' => false,
            'baseUrl' => '/backend/web',
            'rules' => [
                '' => 'site/index',
                'site/index' => 'site/index',
                'noticia' => 'noticia/index',
                'noticia/index' => 'noticia/index',
                'noticia/<action:\w+>/<id:\d+>' => 'noticia/<action>',
                'noticia/<action:\w+>' => 'noticia/<action>',
                'categoria' => 'categoria/index',
                'categoria/index' => 'categoria/index',
                'categoria/<action:\w+>/<id:\d+>' => 'categoria/<action>',
                'categoria/<action:\w+>' => 'categoria/<action>',
                'parceiro' => 'parceiro/index',
                'parceiro/index' => 'parceiro/index',
                'parceiro/<action:\w+>/<id:\d+>' => 'parceiro/<action>',
                'parceiro/<action:\w+>' => 'parceiro/<action>',
                'socio' => 'socio/index',
                'socio/index' => 'socio/index',
                'socio/<action:\w+>/<id:\d+>' => 'socio/<action>',
                'socio/<action:\w+>' => 'socio/<action>',
                'boletos' => 'socio/boletos',
            ],
        ],
        'assetManager' => [
            'basePath' => '@app/web/assets',
            'baseUrl' => '@web/assets',
        ],
    ],
    'params' => $params,
];
