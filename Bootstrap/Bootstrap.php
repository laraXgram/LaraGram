<?php

namespace Bot\Bootstrap;

use Bot\Core\App;
use Bot\Core\Connect\Mysql;
use Dotenv\Dotenv;
use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Support\Facades\Facade;

class Bootstrap
{
    public function __construct()
    {
        /*
         * Require Composer Autoloader
         * */
        require_once getcwd() . '/vendor/autoload.php';

        /*
         * Load .env, Configs
         * */
        Dotenv::createImmutable(getcwd())->load();

        /*
         * Load Class
         * */
        // $this->classLoader();

        /*
         * Connect Databases
         * */
        if ($_ENV['DB_POWER'] === 'on' && class_exists(Capsule::class)) {
            (new Mysql)->connect();
        }

        /*
         * Define Request_Methode Constant
         * */
        define("REQUEST_METHODE_CURL", 32);
        define("REQUEST_METHODE_NO_RESPONSE_CURL", 64);
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
                "Bot\\Core\\" => "Core",
                "Bot\\Bootstrap\\" => "Bootstrap",
                "Bot\\App\\" => "App",
                // "namespace" => 'folder',
                // "LaraGram\\TestNamespace => "LaraGram/TestFolder",
            ];
            foreach ($namespacePrefixes as $namespacePrefix => $directory) {
                $prefixLength = strlen($namespacePrefix);
                if (str_contains($className, $namespacePrefix)) {
                    $relativeClass = substr($className, $prefixLength);
                    $part = explode('\\', $relativeClass);
                    if (!in_array('Model', $part)){
                        $lastKey = key(array_slice($part, -1, 1, true));
                        $part[$lastKey] = lcfirst($part[$lastKey]);
                    }
                    $relativeClass = implode('\\', $part);

                    $file = $dir . DIRECTORY_SEPARATOR . $directory . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $relativeClass) . '.php';
                    require_once $file;
                }
            }
        });
    }
}

new Bootstrap();