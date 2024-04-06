<?php

namespace LaraGram\Core\Cli\Error;

class Log
{
    public static function set(string $file, Level $level, mixed $text)
    {
        $log =
            "[ " .
            date("Y-m-d H:i:s") .
            " ] → " .
            "[ {$level->value} ]" .
            " ↓ " . PHP_EOL .
            "    [ Message ] → " . preg_replace('/((?:\w+\W+){7})/', '$1' . PHP_EOL . "    ", $text) .
            PHP_EOL .
            "▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬" .
            PHP_EOL;
        file_put_contents(getcwd() . '/Logs/' . $file . '.log', $log, FILE_APPEND);
    }
}

