<?php

namespace Bot\Core\Cli\Action;

use Bot\Core\Cli\Error\Logger;
use Symfony\Component\Process\Process;

class Installer
{
    private mixed $cmd;

    public function __construct()
    {
        global $argv;
        $this->cmd = $argv;
    }

    public function install_Eloquent(): void
    {
        if (file_exists('vendor/illuminate/database')){
            Logger::status('Failed', 'Database Eloquent already installed!', 'failed', true);
        }

        $command = new Process(["composer", "require", "illuminate/database", "illuminate/events", "doctrine/dbal"]);
        $command->start();
        $command->wait();
        if ($command->isSuccessful()) {
            Logger::success('Database Eloquent Installed Successfully!');
        }
    }

    public function uninstall_Eloquent(): void
    {
        if (!file_exists('vendor/illuminate/database')){
            Logger::status('Failed', 'Database Eloquent not installed!', 'failed', true);
        }

        $command = new Process(["composer", "remove", "illuminate/database", "illuminate/events", "doctrine/dbal"]);
        $command->start();
        $command->wait();
        if ($command->isSuccessful()) {
            Logger::success('Database Eloquent Removed Successfully!');
        }
    }

    public function install_Amphp(): void
    {
        if (file_exists('vendor/amphp')){
            Logger::status('Failed', 'AMPHP already installed!', 'failed', true);
        }

        $command = new Process(["composer", "require", "amphp/http-client"]);
        $command->start();
        $command->wait();
        if ($command->isSuccessful()) {
            Logger::success('AMPHP Installed Successfully!');
        }
    }

    public function uninstall_Amphp(): void
    {
        if (!file_exists('vendor/amphp')){
            Logger::status('Failed', 'AMPHP not installed!', 'failed', true);
        }

        $command = new Process(["composer", "remove", "amphp/http-client"]);
        $command->start();
        $command->wait();
        if ($command->isSuccessful()) {
            Logger::success('AMPHP Removed Successfully!');
        }
    }
}