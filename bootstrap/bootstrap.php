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

        $this->classLoader();

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

        /*
         * Load Helper Function
         * */
        Runner::LoadFolder('core/helper');
    }

    private function classLoader(): void
    {
        spl_autoload_register(function ($className) {
            $namespacePrefixes = [
                'Bot\\Bootstrap\\' => '../bootstrap',
                'Bot\\Core\\' => '../core',
                'Bot\\App\\' => '../app'
            ];

            foreach ($namespacePrefixes as $namespacePrefix => $directory) {
                $prefixLength = strlen($namespacePrefix);
                if (strncmp($namespacePrefix, $className, $prefixLength) === 0) {
                    $relativeClass = substr($className, $prefixLength);
                    $file = __DIR__ . DIRECTORY_SEPARATOR . $directory . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $relativeClass) . '.php';
                    if (file_exists($file)) {
                        require_once $file;
                        return;
                    }
                }
            }
        });
    }
}

new Bootstrap();