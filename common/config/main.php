<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => \yii\caching\FileCache::class,
        ],
        'db' => [
            'class' => \yii\db\Connection::class,
            'dsn' => 'mysql:host=127.0.0.1;port=3306;dbname=sinpaptep;charset=utf8mb4',
            'username' => 'sinpaptep',
            'password' => 'b3+T/geK,c9yx8',
            'charset' => 'utf8mb4',
            'enableSchemaCache' => true,
            'schemaCacheDuration' => 60,
            'schemaCache' => 'cache',
            'attributes' => [
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci; SET SESSION sql_mode = 'NO_AUTO_VALUE_ON_ZERO'",
            ],
        ],
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@common/mail',
            // send all mails to a file by default.
            'useFileTransport' => false,
            'transport' => [
                'dsn' => 'smtp://sindicatopublicitariosrs@gmail.com:prkzulvrdthjgkbh@smtp.gmail.com:587'
            ],
        ],
    ],
];
