<?php

require_once __DIR__ . '/bootstrap/app.php';

return [
    'paths' => [
        'migrations' => 'resources/migrations',
        'seeds' => 'resources/seeds'
    ],
    'environments' => [
        'default_migration_table' => 'ms_migrations',
        'default_environment' => 'development',
        'development' => [
            'adapter'   => 'mysql',
            'host' => env('DB_HOST'),
            'name' => env('DB_DATABASE'),
            'user' => env('DB_USERNAME'),
            'pass' => env('DB_PASSWORD'),
            'charset'  => 'utf8',
            'port' => env('DB_PORT')
        ],
        'github_actions' => [
            'adapter'   => 'mysql',
            'host' => env('DB_HOST'),
            'name' => env('DB_DATABASE'),
            'user' => env('DB_USERNAME'),
            'pass' => env('DB_PASSWORD'),
            'charset'  => 'utf8',
            'port' => env('DB_PORT'),
            'migrations' => 'resources/github_actions_migrations'
        ],
    ],
];