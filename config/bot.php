<?php

return [
    'connections' => [

        'default' => [
            'token' => '',
            'domain' => '',
            'username' => '',
            'userid' => ''
        ],

    ],

    'api_server' => [

        'endpoint' => 'https://api.telegram.org/',
        'dir' => storage_path("framework/api-server"),
        'log_dir' => '',
        'ip' => '127.0.0.1',
        'port' => 8081,
        'stat' => [
            'ip' => '',
            'port' => ''
        ],
        'api_id' => '',
        'api_hash' => ''

    ],
];