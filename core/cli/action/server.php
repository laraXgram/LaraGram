<?php

namespace Bot\Core\Cli\Action;

use Bot\Core\Cli\Error\Logger;
use Bot\Core\Cli\Kernel;
use Bot\Core\Request;
use Symfony\Component\Process\Process;

class Server
{
    private mixed $cmd;

    public function __construct()
    {
        global $argv;
        $this->cmd = $argv;
    }

    public function setWebhook(): void
    {
        $env = (new Kernel())->checkEnvSet('BOT_DOMAIN', 'BOT_TOKEN');
        if ($env !== []){
            $item = implode(', ', $env);
            Logger::status('ENV ERR', "Please set {$item} in .env file!", 'failed', true);
        }

        $request = new Request();
        $result = $request->setWebhook($_ENV['BOT_DOMAIN']);

        if ($result['ok'] === true) {
            Logger::status('Success', $result['description']);
        } else {
            Logger::status('Failed', $result['description'], 'failed');
        }
    }

    public function deleteWebhook(): void
    {

        $request = new Request();
        $result = $request->deleteWebhook();

        if ($result['ok'] === true) {
            Logger::status('Success', $result['description']);
        } else {
            Logger::status('Failed', $result['description'], 'failed');
        }
    }

    public function serve(): void
    {
        $null = (new Kernel())->checkEnvSet('BOT_API_SERVER');
        if ($null !== []) {
            Logger::status('ENV ERR', "Please set BOT_API_SERVER in .env file!", 'failed');
            return;
        }

        $webServer = new Process(["php", "-S", "{$_ENV['SERVER_IP']}:{$_ENV['SERVER_PORT']}"]);
        $webServer->setTimeout(108000);
        $webServer->start();
        if ($webServer->isStarted()) {
            Logger::success("WebServer Started on {$_ENV['SERVER_IP']}:{$_ENV['SERVER_PORT']}");
        }
        if (isset($this->cmd[2]) && $this->cmd[2] === '--api-server') {
            $null = (new Kernel())->checkEnvSet('BOT_API_SERVER_DIR', 'API_ID', 'API_HASH');
            if ($null !== []) {
                Logger::title('ENV ERR');
                $item = implode(', ', $null);
                Logger::status('ENV ERR', "Please set {$item} in .env file!", 'failed');
                return;
            }

            if ($_ENV['BOT_API_SERVER_LOG_DIR'] === '') {
                $apiServer = new Process(["telegram-bot-api", "--local", "--api-id={$_ENV['API_ID']}", "--api-hash={$_ENV['API_HASH']}", "--dir={$_ENV['BOT_API_SERVER_DIR']}"]);
            } else {
                $apiServer = new Process(["telegram-bot-api", "--local", "--api-id={$_ENV['API_ID']}", "--api-hash={$_ENV['API_HASH']}", "--dir={$_ENV['BOT_API_SERVER_DIR']}", "--log={$_ENV['BOT_API_SERVER_LOG_DIR']}"]);
            }

            $apiServer->setTimeout(108000);
            $apiServer->start();
            if ($apiServer->isStarted()) {
                Logger::success('Bot API Server Started');
            }
        }
        $webServer->wait();
        if (isset($apiServer)) {
            $apiServer->wait();
        }
    }

    public function runApiServer(): void
    {
        $null = (new Kernel())->checkEnvSet('BOT_API_SERVER', 'BOT_API_SERVER_DIR', 'API_ID', 'API_HASH');
        if ($null !== []) {
            Logger::title('ENV ERR');
            $item = implode(', ', $null);
            Logger::status('ENV ERR', "Please set {$item} in .env file!", 'failed');
            return;
        }

        if ($_ENV['BOT_API_SERVER_LOG_DIR'] === '') {
            $apiServer = new Process(["telegram-bot-api", "--local", "--api-id={$_ENV['API_ID']}", "--api-hash={$_ENV['API_HASH']}", "--dir={$_ENV['BOT_API_SERVER_DIR']}"]);
        } else {
            $apiServer = new Process(["telegram-bot-api", "--local", "--api-id={$_ENV['API_ID']}", "--api-hash={$_ENV['API_HASH']}", "--dir={$_ENV['BOT_API_SERVER_DIR']}", "--log={$_ENV['BOT_API_SERVER_LOG_DIR']}"]);
        }

        $apiServer->setTimeout(108000);
        $apiServer->start();
        if ($apiServer->isStarted()) {
            Logger::success('Bot API Server Started');
        }
        $apiServer->wait();
    }
}