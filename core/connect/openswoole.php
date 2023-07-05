<?php

namespace Bot\Core\Connect;

use Bot\Core\Cli\Error\Logger;
use OpenSwoole\Http\Server;
use OpenSwoole\Http\Request;
use OpenSwoole\Http\Response;

class Openswoole {
    public static function connect(): void
    {
        $server = new OpenSwoole\HTTP\Server($_ENV['OPENSWOOLE_IP'], $_ENV['OPENSWOOLE_PORT']);

        $server->on("start", function (Server $server) {
            Logger::status('Success', "OpenSwoole http server is started at {$_ENV['OPENSWOOLE_IP']}:{$_ENV['OPENSWOOLE_PORT']}");
        });

        // Coming Soon ...

        $server->start();
    }
}