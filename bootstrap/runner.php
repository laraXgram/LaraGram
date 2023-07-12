<?php

namespace Bot\Bootstrap;

use Bot\Core\Connect\Openswoole;

class Runner
{
    public static function start(): void
    {
        $files = json_decode(file_get_contents('bootstrap/load.json'), true);
        foreach ($files as $file) {
            if (!isset(Openswoole::$openswoole)){
                require_once $file;
            }else{
                require $file;
            }
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