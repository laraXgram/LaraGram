<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | This option defines the default authentication "guard" and password
    | reset "broker" for your application. You may change these values
    | as required, but they're a perfect start for most applications.
    |
    */

    'defaults' => [
        'guard' => env('AUTH_GUARD', 'web'),
        'passwords' => env('AUTH_PASSWORD_BROKER', 'users'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | Next, you may define every authentication guard for your application.
    | Of course, a great default configuration has been defined for you
    | which utilizes session storage plus the Eloquent user provider.
    |
    | All authentication guards have a user provider, which defines how the
    | users are actually retrieved out of your database or other storage
    | system used by the application. Typically, Eloquent is utilized.
    |
    | Supported: "bot" | "session"
    |
    */

    'guards' => [
        'bot' => [
            'driver' => 'bot',
            'provider' => 'users',
        ],

        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
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
    | Resetting Passwords
    |--------------------------------------------------------------------------
    |
    | These configuration options specify the behavior of Laravel's password
    | reset functionality, including the table utilized for token storage
    | and the user provider that is invoked to actually retrieve users.
    |
    | The expiry time is the number of minutes that each reset token will be
    | considered valid. This security feature keeps tokens short-lived so
    | they have less time to be guessed. You may change this as needed.
    |
    | The throttle setting is the number of seconds a user must wait before
    | generating more password reset tokens. This prevents the user from
    | quickly generating a very large amount of password reset tokens.
    |
    */

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    |
    | Here you may define the number of seconds before a password confirmation
    | window expires and users are asked to re-enter their password via the
    | confirmation screen. By default, the timeout lasts for three hours.
    |
    */

    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),

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
