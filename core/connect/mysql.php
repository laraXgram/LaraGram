<?php

namespace Bot\Core\Connect;

use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;

class Mysql {
    public static function connect(): void
    {
        $capsule = new Capsule;
        $capsule->addConnection([
            'driver' => $_ENV['MYSQL_DRIVER'],
            'host' => $_ENV['MYSQL_HOST'],
            'database' => $_ENV['MYSQL_DATABASE'],
            'username' => $_ENV['MYSQL_USERNAME'],
            'password' => $_ENV['MYSQL_PASSWORD'],
            'charset' => $_ENV['MYSQL_CHARSET'],
            'collation' => $_ENV['MYSQL_COLLATION'],
            'prefix' => $_ENV['MYSQL_PREFIX'],
        ]);

        $capsule->bootEloquent();
        $capsule->setAsGlobal();

        $container = new Container;
        $dispatcher = new Dispatcher($container);

        $capsule->setEventDispatcher($dispatcher);
    }
}