<?php

use LaraGram\Log\Logger\Handler\NullHandler;
use LaraGram\Log\Logger\Handler\StreamHandler;
use LaraGram\Log\Logger\Processor\PsrLogMessageProcessor;

return [

    'default' => 'stack',

    'deprecations' => [
        'channel' => 'null',
        'trace' => false,
    ],

    'channels' => [

        'stack' => [
            'driver' => 'stack',
            'channels' => explode(',', 'single'),
            'ignore_exceptions' => false,
        ],

        'single' => [
            'driver' => 'single',
            'path' => storage_path('logs/laragram.log'),
            'level' => 'debug',
            'replace_placeholders' => true,
        ],

        'daily' => [
            'driver' => 'daily',
            'path' => storage_path('logs/laragram.log'),
            'level' => 'debug',
            'days' => 14,
            'replace_placeholders' => true,
        ],

        'slack' => [
            'driver' => 'slack',
            'url' => null,
            'username' => 'Laravel Log',
            'emoji' => ':boom:',
            'level' => 'critical',
            'replace_placeholders' => true,
        ],

        'stderr' => [
            'driver' => 'laragram',
            'level' => 'debug',
            'handler' => StreamHandler::class,
            'formatter' => null,
            'with' => [
                'stream' => 'php://stderr',
            ],
            'processors' => [PsrLogMessageProcessor::class],
        ],

        'syslog' => [
            'driver' => 'syslog',
            'level' => 'debug',
            'facility' => LOG_USER,
            'replace_placeholders' => true,
        ],

        'errorlog' => [
            'driver' => 'errorlog',
            'level' => 'debug',
            'replace_placeholders' => true,
        ],

        'null' => [
            'driver' => 'laragram',
            'handler' => NullHandler::class,
        ],

        'emergency' => [
            'path' => storage_path('logs/laragram.log'),
        ],

    ],

];
