<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Conversation State Store
    |--------------------------------------------------------------------------
    |
    | The cache store used to persist conversation state. Set to null to use
    | the default cache store, or name any store defined in config/cache.php
    | (e.g. "redis", "array") to keep conversation state on a faster driver.
    |
    */

    'store' => env('CONVERSATION_STORE'),

    /*
    |--------------------------------------------------------------------------
    | Conversations Path
    |--------------------------------------------------------------------------
    |
    | The directory where conversation files live. Each file returns an
    | anonymous class extending LaraGram\Conversation\Conversation, the same
    | way migrations return an anonymous migration. Null uses app/Conversations.
    |
    */

    'path' => app_path('Conversation'),

    /*
    |--------------------------------------------------------------------------
    | Cache Key Prefix & Lifetime
    |--------------------------------------------------------------------------
    |
    | The prefix applied to conversation cache keys and the maximum lifetime
    | (in seconds) a conversation's state is retained in the cache before it
    | naturally expires.
    |
    */

    'prefix' => 'conversation',

    'lifetime' => 3600,

    /*
    |--------------------------------------------------------------------------
    | Conversation Defaults
    |--------------------------------------------------------------------------
    |
    | Fallback values used when a conversation does not declare the matching
    | public property ($maxAttempts, $cancelCommand, $cancelTimeout,
    | $forgotAfterComplete). The timeout is the number of seconds of inactivity
    | after which a conversation is cancelled. Null disables a setting.
    |
    */

    'max_attempts' => 3,

    'cancel_command' => null,

    'cancel_timeout' => null,

    'forget_after_complete' => true,

];
