<?php

return [
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => getenv('COOKIE_VALIDATION_KEY_BACKEND') ?: '',
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
                'site/index' => 'site/index',
                'noticia' => 'noticia/index',
                'noticia/<action:\w+>/<id:\d+>' => 'noticia/<action>',
                'noticia/<action:\w+>' => 'noticia/<action>',
                'categoria' => 'categoria/index',
                'categoria/<action:\w+>/<id:\d+>' => 'categoria/<action>',
                'categoria/<action:\w+>' => 'categoria/<action>',
                'parceiro' => 'parceiro/index',
                'parceiro/<action:\w+>/<id:\d+>' => 'parceiro/<action>',
                'parceiro/<action:\w+>' => 'parceiro/<action>',
                'socio' => 'socio/index',
                'socio/<action:\w+>/<id:\d+>' => 'socio/<action>',
                'socio/<action:\w+>' => 'socio/<action>',
                'boletos' => 'socio/boletos',
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
