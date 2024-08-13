<?php

return [
    # SQL Database
    /*
     * DB_POWER : Database status.
     * 1 - on
     * 2 - off
     * If you don't use the database, leave it <off> to avoid load the related classes.
     * (Required)
     */
    'DB_POWER'     => 'off',
    'DB_DRIVER'    => 'mysql',
    'DB_HOST'      => '127.0.0.1',
    'DB_PORT'      => '3306',
    'DB_DATABASE'  => 'laragram',
    'DB_USERNAME'  => 'root',
    'DB_PASSWORD'  => '',
    'DB_CHARSET'   => 'utf8mb4',
    'DB_COLLATION' => 'utf8mb4_general_ci',
    'DB_PREFIX'    => '',

    # Redis
    'REDIS_IP'       => '127.0.0.1',
    'REDIS_PORT'     => '6379',
    'REDIS_USERNAME' => '',
    'REDIS_PASSWORD' => '',
    'REDIS_DATABASE' => '9000',

    # JSon Database
    /*
     * ! IMPORTANT DIRECTORY !
     * All data will be stored in this folder, so please ensure its security.
     * Data may be lost in case of accidental deletion.
     */
    'JSON_DB_DATA_DIR' => 'Storage/App/JDB/',
];