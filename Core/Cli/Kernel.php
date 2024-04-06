<?php

namespace LaraGram\Core\Cli;

use LaraGram\Core\Cli\Error\Logger;

class Kernel
{
    private mixed $cmd;

    public function __construct()
    {
        global $argv;
        $this->cmd = $argv;
    }

    public function checkEnvSet(...$keys): array
    {
        $null = [];
        foreach ($keys as $key) {
            if ($_ENV[$key] === '') {
                $null[] = $key;
            }
        }
        return $null;
    }

    public function call(string $arg, callable $action, ...$data): void
    {
        if ($this->cmd[1] === $arg) {
            call_user_func($action, ...$data);
            exit();
        }
    }

    public function shutdown(): void
    {
        Logger::failed('Failed');
        Logger::message('Command not found!');
    }
}