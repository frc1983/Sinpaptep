<?php

/**
 * Production-only overrides.
 *
 * This file is loaded after *-local.php files so stale configuration left on a
 * shared hosting account can never replace credentials provided at deploy time.
 */
if (!defined('YII_ENV') || YII_ENV !== 'prod') {
    return [];
}

return [
    'components' => [
        'db' => [
            'dsn' => getenv('DB_DSN') ?: '',
            'username' => getenv('DB_USERNAME') ?: '',
            'password' => getenv('DB_PASSWORD') ?: '',
        ],
        'mailer' => [
            'useFileTransport' => filter_var(getenv('MAILER_USE_FILE_TRANSPORT') ?: '0', FILTER_VALIDATE_BOOLEAN),
            'transport' => [
                'dsn' => getenv('MAILER_DSN') ?: '',
            ],
        ],
    ],
];
