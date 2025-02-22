<?php

return [
    /*
     * The type of update received.
     * 1 - global (default)
     * 2 - openswoole
     * 3 - swoole
     * 4 - polling
     * 5 - amp
     * 6 - fiber
     * (Required)
     */
    'update_type' => 'global',

    /*
     * The Request submission type.
     * 1 - curl (default)
     * 2 - no_response_curl
     * (Required)
     */
    'default_mode' => 'curl',

    /*
     * Long Polling
     * (Required on polling mode)
     */
    'polling' => [
        'timeout' => 100,
        'sleep_interval' => 0.5,
        'limit' => 100,
        'allow_updates' => ["*"]
    ],
];