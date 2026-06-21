<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | This option defines the default authentication "provider" for your
    | application. You may change these valuesas required, but they're
    | a perfect start for most applications.
    |
    */

    'defaults' => [
        'provider' => env('AUTH_PROVIDER', 'users'),
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | All authentication guards have a user provider, which defines how the
    | users are actually retrieved out of your database or other storage
    | system used by the application. Typically, Eloquent is utilized.
    |
    | If you have multiple user tables or models you may configure multiple
    | providers to represent the model / table.
    |
    | Supported: "database", "eloquent"
    |
    */

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => env('AUTH_MODEL', App\Models\User::class),
            'column' => 'user_id',
        ],

        // 'users' => [
        //     'driver' => 'database',
        //     'table' => 'users',
        //     'column' => 'user_id',
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Chat-Member Status
    |--------------------------------------------------------------------------
    |
    | Authorization helpers such as `->can('administrator')` resolve a user's
    | Telegram chat-member status through one of the drivers below.
    | Pick the strategy that fits your bot:
    |
    |   "live"     – ask Telegram (getChatMember) on demand, cached per
    |                request. Always fresh, no storage, no migrations.
    |   "eloquent" – read the status from an Eloquent model. Fully
    |                customizable model / columns (no hard User coupling).
    |   "database" – read the status straight from a database table.
    |   "cache"    – read the status from any cache store (redis, memcached,
    |                file, array, ...). Great for a fast, disposable mirror.
    |
    | The chat_member / my_chat_member updates are observed and written back
    | through the active driver to keep the mirror in sync. Left as null this
    | is automatic: every writable driver (eloquent / database / cache) observes
    | while the read-only "live" driver does not. Set it to true / false to
    | force observing on or off (e.g. when the mirror is filled elsewhere).
    |
    */

    'status' => [

        'default' => env('AUTH_STATUS_DRIVER', 'live'),

        'observe' => env('AUTH_STATUS_OBSERVE', null),

        'drivers' => [

            'live' => [
                'driver' => 'live',
            ],

            'eloquent' => [
                'driver' => 'eloquent',
                'model' => env('AUTH_MODEL', App\Models\User::class),
                'status_column' => 'status',
                'user_column' => 'user_id',
                'chat_column' => 'chat_id',
            ],

            'database' => [
                'driver' => 'database',
                'connection' => env('AUTH_STATUS_CONNECTION'),
                'table' => 'users',
                'status_column' => 'status',
                'user_column' => 'user_id',
                'chat_column' => 'chat_id',
            ],

            'cache' => [
                'driver' => 'cache',
                'store' => env('AUTH_STATUS_CACHE_STORE'),
                'prefix' => 'chat_status',
                'ttl' => env('AUTH_STATUS_CACHE_TTL', 3600),
            ],

        ],

    ],

];
