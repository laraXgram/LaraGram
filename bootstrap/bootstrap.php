<?php

namespace Bot\Bootstrap;

use Bot\Core\Connect\Mysql;
use Dotenv\Dotenv;
use Illuminate\Database\Capsule\Manager as Capsule;

class Bootstrap
{
    public function __construct()
    {
        /*
         * Require Composer Autoloader
         * */
        require_once 'vendor/autoload.php';

        /*
         * Load .env, Configs
         * */
        Dotenv::createImmutable(getcwd())->load();

        /*
         * Connect Databases
         * */
        if ($_ENV['MYSQL_POWER'] === 'on' && class_exists(Capsule::class)) {
            Mysql::connect();
        }

        /*
         * Define Request_Methode Constant
         * */
        define("REQUEST_METHODE_CURL", 32);
        define("REQUEST_METHODE_PARALLEL_CURL", 64);
        define("REQUEST_METHODE_AMPHP", 128);
        define("REQUEST_METHODE_OPENSWOOLE", 256);
    }
}

new Bootstrap();