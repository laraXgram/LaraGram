<?php

namespace Bot\Core\Connect;

use Bot\Core\Cli\Db\Migration;
use Bot\Core\Cli\Error\Logger;
use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Facade;
use newrelic\DistributedTracePayload;

class Mysql
{
    public function connect(): void
    {
        if (!file_exists('vendor/illuminate/database')) {
            Logger::status('Failed', 'Please Install Database Eloquent!', 'failed', true);
        }

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

        $app = new Container();
        Facade::setFacadeApplication($app);

        $this->migrations();
    }

    private function migrations(): void
    {
        if (!Capsule::schema()->hasTable('migrations')) {
            Capsule::schema()->create('migrations', function (Blueprint $table) {
                $table->id();
                $table->string('migration');
                $table->integer('batch');
            });
        }
    }
}