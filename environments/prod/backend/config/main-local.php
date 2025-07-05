<?php

return [
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'Qw8z2nV7pLk4sT1xRj6bYc9uHf3eGm5aSd0Xv2WqZt7Jr8PlB',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
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
        'log' => [
            'traceLevel' => 0,
            'targets' => [
                [
                    'class' => \yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                    'logFile' => '@runtime/logs/app.log',
                ],
            ],
        ],
    ],
];
