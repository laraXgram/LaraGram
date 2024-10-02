<?php

return [
    'database' => [
        'power' => 'off',
        'driver' => 'mysql',
        'host' => 'localhost',
        'port' => 3306,
        'database' => 'laragram',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_general_ci',
        'prefix' => ''
    ],

    'redis' => [
        'ip' => '127.0.0.1',
        'port' => 6379,
        'username' => '',
        'password' => '',
        'database' => 9000
    ],

    'json' => [
        'storage' => app('path.storage') . "/app/jdb"
    ]
];