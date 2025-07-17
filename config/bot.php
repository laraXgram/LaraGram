<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Bot Connection
    |--------------------------------------------------------------------------
    |
    | The bot connection with which the request is sent by default.
    |
    */

    'default' => 'bot',

    'connections' => [
        'bot' => [
            'token' => '',
            'domain' => '',
            'username' => '',
            'userid' => '',
            'secret_token' => null,
            'allowed_updates' => ['*']
        ],
    ],

    'api_server' => [
        'endpoint' => 'https://api.telegram.org',
        'dir' => storage_path('app/api-server'),
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
