<?php

namespace Bot\Core\Handler;

use Closure;

class Timer
{
    public static function after(int|float $time, Closure $action)
    {
        sleep($time);
        return $action();
    }

    public static function uAfter(int|float $time, Closure $action)
    {
        usleep($time);
        return $action();
    }
    public static function wait(int|float $time): bool
    {
        sleep($time);
        return true;
    }

    public static function uWait(int|float $time): bool
    {
        usleep($time);
        return true;
    }
}