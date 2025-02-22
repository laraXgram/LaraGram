<?php

return [
    'default' => 'database',

    'connections' => [

        'sync' => [
            'driver' => 'sync',
        ],

        'database' => [
            'driver' => 'database',
            'connection' => 'mysql',
            'table' => 'jobs',
            'queue' => 'default',
            'retry_after' => 5,
            'after_commit' => false,
        ],

        'redis' => [
            'driver' => 'redis',
            'connection' => 'default',
            'queue' => 'default',
            'retry_after' => 90,
            'block_for' => null,
            'after_commit' => false,
        ],

    ],

    'batching' => [
        'database' => 'mysql',
        'table' => 'job_batches',
    ],

    'failed' => [
        'driver' => 'database-uuids',
        'database' => 'mysql',
        'table' => 'failed_jobs',
    ],

];
