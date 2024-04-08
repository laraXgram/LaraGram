<?php

namespace LaraGram\Core\Connect;

use LaraGram\Core\Cli\Error\Logger;
use OpenSwoole\Http\Request;
use OpenSwoole\Http\Response;
use OpenSwoole\Http\Server;

class Openswoole {
    public static int $openswooleStatus = 0;
    public static mixed $openswoole;
    public static function connect(): void
    {
        if (!file_exists('vendor/openswoole')){
            Logger::status('Failed', 'Please Install Openswoole!', 'failed', true);
        }

        $server = new Server($_ENV['OPENSWOOLE_IP'], $_ENV['OPENSWOOLE_PORT']);

        $server->on("start", function () {
            Logger::success("OpenSwoole http server is started at {$_ENV['OPENSWOOLE_IP']}:{$_ENV['OPENSWOOLE_PORT']}");
        });

        $server->on("request", function (Request $swooleRequest, Response $swooleResponse){
            $swooleResponse->end();

            self::$openswoole = json_decode($swooleRequest->getContent(), true);
            self::$openswooleStatus = 1;

            require 'index.php';

            self::$openswoole = null;
            self::$openswooleStatus = 0;
        });

        $server->start();
    }
}