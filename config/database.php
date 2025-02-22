<?php

use LaraGram\Support\Str;

return [
    'default' => 'mysql',

    'connections' => [

        'sqlite' => [
            'driver' => 'sqlite',
            'url' => 'sqlite://localhost',
            'database' => database_path('database.sqlite'),
            'prefix' => '',
            'foreign_key_constraints' => true,
        ],

        'mysql' => [
            'driver' => 'mysql',
            'url' => 'mysql://localhost',
            'host' => '127.0.0.1',
            'port' => '3306',
            'database' => 'laragram',
            'username' => 'root',
            'password' => '',
            'unix_socket' => '',
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => '',
            ]) : [],
        ],

        'mariadb' => [
            'driver' => 'mariadb',
            'url' => 'mariadb://localhost',
            'host' => '127.0.0.1',
            'port' => '3306',
            'database' => 'laragram',
            'username' => 'root',
            'password' => '',
            'unix_socket' => '',
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => '',
            ]) : [],
        ],

        'pgsql' => [
            'driver' => 'pgsql',
            'url' => 'pgsql://localhost',
            'host' => '127.0.0.1',
            'port' => '5432',
            'database' => 'laragram',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'search_path' => 'public',
            'sslmode' => 'prefer',
        ],

        'sqlsrv' => [
            'driver' => 'sqlsrv',
            'url' => 'sqlsrv://localhost',
            'host' => 'localhost',
            'port' => '1433',
            'database' => 'laravel',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            // 'encrypt' => 'yes,
            // 'trust_server_certificate' => 'false',
        ],

    ],

    'migrations' => [
        'table' => 'migrations',
        'update_date_on_publish' => true,
    ],

    'redis' => [

        'client' => 'phpredis',

        'options' => [
            'cluster' => 'redis',
            'prefix' => Str::slug(config('app.name', 'laragram'), '_') . '_database_',
        ],

        'default' => [
            'url' => 'redis://localhost',
            'host' => '127.0.0.1',
            'username' => null,
            'password' => '',
            'port' => '6379',
            'database' => '0',
        ],

        'cache' => [
            'url' => 'redis://localhost',
            'host' => '127.0.0.1',
            'username' => null,
            'password' => '',
            'port' => '6379',
            'database' => '1',
        ],

    ],

    'json' => [
        'storage' => datebase_apth("json"),
    ]

];
