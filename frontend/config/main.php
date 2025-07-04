<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'name' => 'Sinpaptep-RS',
    'basePath' => dirname(__DIR__),
    'charset' => 'utf-8',
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'cookieValidationKey' => 'Zp4vX7mQ2sL9wT6kJr1yB8nHc5eGf3aSd0Vx2WqUt7Jr8PlB',
        ],
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@common/mail',
            'useFileTransport' => false,
            'transport' => [
                'dsn' => 'smtp://sindicatopublicitariosrs@gmail.com:prkzulvrdthjgkbh@smtp.gmail.com:587'
            ],
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => \yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '' => 'site/index',
                'noticia/<id:\d+>' => 'site/noticia',
                'noticias' => 'site/noticias',
                'noticias/categoria/<categoriaId:\d+>' => 'site/noticias-por-categoria',
                'buscar' => 'site/buscar-noticias',
                'sobre' => 'site/about',
                'contato' => 'site/contact',
            ],
        ],
    ],
    'params' => $params,
];
