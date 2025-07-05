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
                    'class' => \yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
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
            'normalizer' => [
                'class' => 'yii\web\UrlNormalizer',
                'collapseSlashes' => false,
                'normalizeTrailingSlash' => false,
            ],
            'rules' => [
                '' => 'site/index',
                'login' => 'site/login',
                'logout' => 'site/logout',
                'socio' => 'socio/index',
                'socio/create' => 'socio/create',
                'socio/view/<id:\d+>' => 'socio/view',
                'socio/update/<id:\d+>' => 'socio/update',
                'socio/delete/<id:\d+>' => 'socio/delete',
                'noticia' => 'noticia/index',
                'noticia/create' => 'noticia/create',
                'noticia/view/<id:\d+>' => 'noticia/view',
                'noticia/update/<id:\d+>' => 'noticia/update',
                'noticia/delete/<id:\d+>' => 'noticia/delete',
                'parceiro' => 'parceiro/index',
                'parceiro/create' => 'parceiro/create',
                'parceiro/view/<id:\d+>' => 'parceiro/view',
                'parceiro/update/<id:\d+>' => 'parceiro/update',
                'parceiro/delete/<id:\d+>' => 'parceiro/delete',
                'categoria' => 'categoria/index',
                'categoria/create' => 'categoria/create',
                'categoria/view/<id:\d+>' => 'categoria/view',
                'categoria/update/<id:\d+>' => 'categoria/update',
                'categoria/delete/<id:\d+>' => 'categoria/delete',
                'anunciante' => 'anunciante/index',
                'anunciante/create' => 'anunciante/create',
                'anunciante/view/<id:\d+>' => 'anunciante/view',
                'anunciante/update/<id:\d+>' => 'anunciante/update',
                'anunciante/delete/<id:\d+>' => 'anunciante/delete',
                'pagina' => 'pagina/index',
                'pagina/create' => 'pagina/create',
                'pagina/view/<id:\d+>' => 'pagina/view',
                'pagina/update/<id:\d+>' => 'pagina/update',
                'pagina/delete/<id:\d+>' => 'pagina/delete',
            ],
        ],
    ],
    'params' => $params,
];
