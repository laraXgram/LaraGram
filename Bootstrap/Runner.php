<?php

namespace LaraGram\Bootstrap;

use LaraGram\Core\Connect\Openswoole;

class Runner
{
    public static function start(): void
    {
        $files = json_decode(file_get_contents('Bootstrap/load.json'), true);
        foreach ($files as $file) {
            !isset(Openswoole::$openswoole) ? require_once $file : require $file;
        }
    }

    public static function LoadFolder(string $folderPath): void
    {
        $files = scandir($folderPath);
        foreach ($files as $file) {
            if (is_file($folderPath . '/' . $file)) {
                require_once $folderPath . '/' . $file;
            }
        }
    }
}
