<?php

declare(strict_types=1);

return [
    'env' => getenv('APP_ENV') ?: 'production',
    'debug' => filter_var(getenv('APP_DEBUG') ?: '0', FILTER_VALIDATE_BOOLEAN),
    'db' => [
        'host'     => getenv('MYSQL_HOST') ?: 'mysql',
        'database' => getenv('MYSQL_DATABASE') ?: 'landing_institut',
        'user'     => getenv('MYSQL_USER') ?: 'landing_user',
        'password' => getenv('MYSQL_PASSWORD') ?: 'landing_secret',
        'charset'  => 'utf8mb4',
    ],
    'upload_path' => __DIR__ . '/../uploads',
    'upload_url'  => '/uploads/',
];
