<?php

namespace Bot\Core\Connect;

use Bot\Core\Cli\Error\Logger;
use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Facade;

class Mysql
{
    public function connect(): void
    {
        if (!file_exists('vendor/illuminate/database')) {
            Logger::status('Failed', 'Please Install Database Eloquent!', 'failed', true);
        }

        $capsule = new Capsule;
        $capsule->addConnection([
            'driver' => $_ENV['DB_DRIVER'],
            'host' => $_ENV['DB_HOST'],
            'database' => $_ENV['DB_DATABASE'],
            'username' => $_ENV['DB_USERNAME'],
            'password' => $_ENV['DB_PASSWORD'],
            'charset' => $_ENV['DB_CHARSET'],
            'collation' => $_ENV['DB_COLLATION'],
            'prefix' => $_ENV['DB_PREFIX'],
        ]);

        $capsule->bootEloquent();
        $capsule->setAsGlobal();

        $app = new Container();
        Facade::setFacadeApplication($app);
    }

    public function create_migrations_table(): void
    {
        if (!(Capsule::schema()->hasTable('migrations'))) {
            Capsule::schema()->create('migrations', function (Blueprint $table) {
                $table->id();
                $table->string('migration');
                $table->integer('batch');
            });
        }
    }
}