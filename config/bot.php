<?php

return [
    /*
     * The token for your bot provided by the BotFather.
     * (Required)
     */
    'BOT_TOKEN' => '',

    /*
     * The domain where your bot is hosted.
     * Used for setWebhook command.
     * (Optional)
     */
    'BOT_DOMAIN' => '',

    /*
     * The username of your bot.
     * (Optional)
     */
    'BOT_USERNAME' => '',

    /*
     * The user ID of your bot.
     * (Optional)
     */
    'BOT_USERID' => '',

    /*
     * The URL of the bot API server.
     * Telegram endpoint <https://api.telegram.org>
     * or
     * your Local Bot API Server
     * (Required)
     */
    'BOT_API_SERVER' => 'https://api.telegram.org',

    /*
     * The directory path for the local bot API server.
     * Leave blank if you are not using local bot api server.
     * (Optional)
     */
    'BOT_API_SERVER_DIR' => app('path.storage') . '/app/apiserver',

    /*
     * The directory path for logs of the bot API server.
     * Leave blank if you don't need logs.
     * (Optional)
     */
    'BOT_API_SERVER_LOG_DIR' => '',

    /*
     * The IP address for the local bot API server.
     * (Optional)
     */
    'BOT_API_SERVER_IP' => '127.0.0.1',

    /*
     * The port for the local bot API server.
     * (Optional)
     */
    'BOT_API_SERVER_PORT' => '8081',

    /*
     * The stat IP address for the local bot API server.
     * (Optional)
     */
    'BOT_API_SERVER_STAT_IP' => '',

    /*
     * The stat port for the local bot API server.
     * (Optional)
     */
    'BOT_API_SERVER_STAT_PORT' => '',

    /*
     * The API ID from your Telegram account.
     * Used for Run Local Telegram Bot API Server.
     * (Optional)
     */
    'API_ID' => '',

    /*
     * The API Hash from your Telegram account.
     * Used for Run Local Telegram Bot API Server.
     * (Optional)
     */
    'API_HASH' => '',

    /*
     * The type of update received.
     * 1 - sync
     * 2 - global (default)
     * 3 - openswoole (recommended)
     * 4 - swoole
     * (Required)
     */
    'UPDATE_TYPE' => 'global',

    /*
     * The Request submission type.
     * 1 - curl (default)
     * 2 - no_response_curl
     * (Required)
     */
    'DEFAULT_MODE' => 'curl',
];