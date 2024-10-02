<?php

return [
    'bot' => [
        'token' => '',
        'domain' => '',
        'username' => '',
        'userid' => ''
    ],

    'api_server' => [
        'endpoint' => 'https://api.telegram.org/',
        'dir' => app('path.storage') . '/API-Server',
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