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
    'BOT_API_SERVER_DIR' => 'Storage/API-Server/',

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