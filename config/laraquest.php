<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Default Mode
    |--------------------------------------------------------------------------
    |
    | Default mode used for Telegram API requests.
    | Supported: curl, no_response_curl
    |
    */
    'default_mode' => 'curl',

    /*
    |--------------------------------------------------------------------------
    | Default API Parameters
    |--------------------------------------------------------------------------
    |
    | Define default optional parameters for Telegram API methods.
    | Defaults can be applied per method or to groups of methods.
    |
    */
    'default_parameters' => [
        'groups' => [
            //
        ]

        //
    ],

    /*
    |--------------------------------------------------------------------------
    | Exceptions
    |--------------------------------------------------------------------------
    |
    | When enabled, a call Telegram refuses throws the exception that matches
    | the failure instead of returning it. Individual calls may opt in or out
    | at any time with $request->throw() and $request->silent().
    |
    */
    'throw_exceptions' => env('LARAQUEST_THROW_EXCEPTIONS', false),

];
