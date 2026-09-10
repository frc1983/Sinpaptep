<?php

return yii\helpers\ArrayHelper::merge(
    require __DIR__ . '/main.php',
    require __DIR__ . '/main-local.php',
    require __DIR__ . '/test.php',
    require __DIR__ . '/test-local.php',
    [
        'components' => [
            'request' => [
                // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
                'cookieValidationKey' => 'Qw8z2nV7pLk4sT1xRj6bYc9uHf3eGm5aSd0Xv2WqZt7Jr8PlB',
            ],
        ],
    ]
);
