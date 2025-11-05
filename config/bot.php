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
            'token' => env("BOT_TOKEN"),
            'url' => env("BOT_URL"),
            'username' => env("BOT_USERNAME", ''),
            'userid' => env("BOT_USERID", ''),
            'secret_token' => null,
            'allowed_updates' => ['*']
        ],
    ],

    'api_server' => [
        'endpoint' => env("API_ENDPOINT", "https://api.telegram.org"),
        'dir' => env("API_DIR", storage_path('app/api-server')),
        'log_dir' => '',
        'ip' => '127.0.0.1',
        'port' => 8081,
        'stat' => [
            'ip' => '',
            'port' => ''
        ],
        'api_id' => env("API_ID", ''),
        'api_hash' => env("API_HASH", ''),
    ],

];
