<?php

namespace Bot\Bootstrap;

class Runner
{
    public static function start(): void
    {
        $files = json_decode(file_get_contents('bootstrap/load.json'), true);
        foreach ($files as $file) {
            require $file;
        }
    }
}