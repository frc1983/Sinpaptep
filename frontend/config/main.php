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
            'enableStrictParsing' => false,
            'rules' => [
                '' => 'site/index',
                'noticia/<id:\d+>' => 'site/noticia',
                'noticias' => 'site/noticias',
                'noticias/categoria/<categoriaId:\d+>' => 'site/noticias-por-categoria',
                'buscar' => 'site/buscar-noticias',
                'sobre' => 'site/about',
                'contato' => 'site/contact',
                'login' => 'site/login',
                'logout' => 'site/logout',
                'signup' => 'site/signup',
                'request-password-reset' => 'site/request-password-reset',
                'reset-password/<token:[\w-]+>' => 'site/reset-password',
                'verify-email/<token:[\w-]+>' => 'site/verify-email',
                'resend-verification-email' => 'site/resend-verification-email',
            ],
        ],
    ],
    'params' => $params,
];
