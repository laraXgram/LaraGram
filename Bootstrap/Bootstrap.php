<?php

namespace LaraGram\Bootstrap;

use LaraGram\Core\Connect\Mysql;
use LaraGram\Core\Connect\Openswoole;
use LaraGram\Core\Helper\Loader;
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
         * Load Helper Function
         * */

        Loader::LoadHelper();
    }

    private function classLoader(): void
    {
        spl_autoload_register(function ($className) {
            $dir = str_replace(DIRECTORY_SEPARATOR . "Bootstrap", '', __DIR__);
            $namespacePrefixes = [
                "LaraGram\\Bootstrap\\" => "Bootstrap",
                "LaraGram\\App\\" => "App",
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

    public static function start(): void
    {
        $files = json_decode(file_get_contents('Bootstrap/load.json'), true);
        foreach ($files as $file) {
            !isset(Openswoole::$openswoole) ? require_once $file : require $file;
        }
    }
}

new Bootstrap();