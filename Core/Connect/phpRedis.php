<?php

namespace Bot\Core\Connect;

use Redis;
use RedisException;

class PhpRedis
{
    /**
     * @throws RedisException
     */
    public static function connect(mixed $database = 9000): Redis|int
    {
        $redis = new Redis();

        if ($_ENV['REDIS_IP'] === '' && $_ENV['REDIS_PORT'] === '') {
            $redis->connect('127.0.0.1');
        }else{
            $redis->connect($_ENV['REDIS_IP'], $_ENV['REDIS_PORT']);
        }

        if ($_ENV['REDIS_DB'] === ''){
            $redis->select($database);
        }else{
            $redis->select($_ENV['REDIS_DB']);
        }

        if ($_ENV['REDIS_USER'] !== '' && $_ENV['REDIS_PASS'] !== '') {
            $redis->auth([$_ENV['REDIS_USER'], $_ENV['REDIS_PASS']]);
        }

        return $redis;
    }
}