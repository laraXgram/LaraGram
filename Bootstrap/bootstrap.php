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
        Runner::LoadFolder('Core/Helper');
    }

    private function classLoader(): void
    {
        spl_autoload_register(function ($className) {
            $dir = str_replace(DIRECTORY_SEPARATOR . "Bootstrap", '', __DIR__);
            $namespacePrefixes = [
                'Bot\\Core\\' => 'Core',
                'Bot\\Bootstrap\\' => 'Bootstrap',
                'Bot\\App\\' => 'App'
            ];
            foreach ($namespacePrefixes as $namespacePrefix => $directory) {
                $prefixLength = strlen($namespacePrefix);
                if (str_contains($className, $namespacePrefix)) {
                    $relativeClass = substr($className, $prefixLength);
                    $part = explode('\\', $relativeClass);
                    $lastKey = key(array_slice($part, -1, 1, true));
                    $part[$lastKey] = lcfirst($part[$lastKey]);
                    $relativeClass = implode('\\', $part);

                    $file = $dir . DIRECTORY_SEPARATOR . $directory . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $relativeClass) . '.php';

                    require_once $file;
                }
            }
        });
    }
}

new Bootstrap();