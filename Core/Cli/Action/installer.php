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
        $command->setTimeout(900);
        $command->start();
        $command->wait();
        if ($command->isSuccessful()) {
            Logger::success('Database Eloquent Installed Successfully!');
        }else{
            Logger::failed('An error occurred!');
        }
    }

    public function uninstall_Eloquent(): void
    {
        if (!file_exists('vendor/illuminate/database')){
            Logger::status('Failed', 'Database Eloquent not installed!', 'failed', true);
        }

        $command = new Process(["composer", "remove", "illuminate/database", "illuminate/events", "doctrine/dbal"]);
        $command->setTimeout(900);
        $command->start();
        $command->wait();
        if ($command->isSuccessful()) {
            Logger::success('Database Eloquent Removed Successfully!');
        }else{
            Logger::failed('An error occurred!');
        }
    }

    public function install_Amphp(): void
    {
        if (file_exists('vendor/amphp')){
            Logger::status('Failed', 'AMPHP already installed!', 'failed', true);
        }

        $command = new Process(["composer", "require", "amphp/http-client"]);
        $command->setTimeout(900);
        $command->start();
        $command->wait();
        if ($command->isSuccessful()) {
            Logger::success('AMPHP Installed Successfully!');
        }else{
            Logger::failed('An error occurred!');
        }
    }

    public function uninstall_Amphp(): void
    {
        if (!file_exists('vendor/amphp')){
            Logger::status('Failed', 'AMPHP not installed!', 'failed', true);
        }

        $command = new Process(["composer", "remove", "amphp/http-client"]);
        $command->setTimeout(900);
        $command->start();
        $command->wait();
        if ($command->isSuccessful()) {
            Logger::success('AMPHP Removed Successfully!');
        }else{
            Logger::failed('An error occurred!');
        }
    }

    public function install_Openswoole(): void
    {
        if (file_exists('vendor/openswoole')){
            Logger::status('Failed', 'OpenSwoole already installed!', 'failed', true);
        }

        $command = new Process(["composer", "require", "openswoole/core"]);
        $command->setTimeout(900);
        $command->start();
        $command->wait();
        if ($command->isSuccessful()) {
            Logger::success('OpenSwoole Installed Successfully!');
        }else{
            Logger::failed('Failed to install OpenSwoole!');
            if (str_contains($command->getErrorOutput(), 'requires ext-openswoole')){
                Logger::message('Make sure the openswoole extension is installed!');
            }else{
                Logger::message('Make sure you are connected to the network!           ');
                Logger::message('If the problem is not solved, directly use the command');
                Logger::message('    >> composer require openswoole/core               ');
            }
        }
    }

    public function uninstall_Openswoole(): void
    {
        if (!file_exists('vendor/openswoole')){
            Logger::status('Failed', 'OpenSwoole not installed!', 'failed', true);
        }

        $command = new Process(["composer", "remove", "openswoole/core"]);
        $command->setTimeout(900);
        $command->start();
        $command->wait();
        if ($command->isSuccessful()) {
            Logger::success('OpenSwoole Removed Successfully!');
        }else{
            Logger::failed('An error occurred!');
        }
    }

    public function install_Redis(): void
    {
        $command = new Process(["composer", "require", "ext-redis:*"]);
        $command->setTimeout(900);
        $command->start();
        $command->wait();
        if ($command->isSuccessful()) {
            Logger::success('Ext-Redis Installed Successfully!');
        }else{
            Logger::failed('Failed to install Ext-Redis!');
        }
    }

    public function uninstall_Redis(): void
    {
        $command = new Process(["composer", "remove", "ext-redis:*"]);
        $command->setTimeout(900);
        $command->start();
        $command->wait();
        if ($command->isSuccessful()) {
            Logger::success('Ext-Redis Removed Successfully!');
        }else{
            Logger::failed('An error occurred!');
        }
    }

    public function clear_vendor(): void
    {
        $command = ["composer", "remove"];
        if (file_exists('vendor/openswoole')){
            $command[] = "openswoole/core";
        }

        if (file_exists('vendor/amphp')){
            $command[] = "amphp/http-client";
        }

        if (file_exists('vendor/illuminate/database')){
            $command = array_merge($command, ["illuminate/database", "illuminate/events", "doctrine/dbal"]);
        }

        $command = new Process($command);
        $command->start();
        $command->wait();
        if ($command->isSuccessful()) {
            Logger::success('Vendor was successfully cleared!');
        }else{
            Logger::failed('An error occurred!');
        }
    }
}