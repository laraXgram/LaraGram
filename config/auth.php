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
    | Observe User Status
    |--------------------------------------------------------------------------
    |
    | Listen for updates to chat_member and my_chat_member
    | and update the database if the user status changes.
    |
    | Need to migrate the default users table.
    |
    */

    'observe_users_status' => false,
];
