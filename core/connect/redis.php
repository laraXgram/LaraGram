<?php

namespace Bot\Core\Connect;

use Bot\Core\Cli\Error\Logger;

class Redis {
    public static function connect(): void
    {
        $redis = new Redis();
        $redis->connect($_ENV['REDIS_IP'], $_ENV['REDIS_PORT']);
        $redis->auth($_ENV['REDIS_PASS']);

        if ($redis->ping()) {
            Logger::status('Success', 'Redis Server Started');
        }

        // Coming Soon ...
    }
}