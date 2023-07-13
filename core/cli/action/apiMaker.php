<?php

namespace Bot\Core\Cli\Action;

use Bot\Core\Cli\Error\Logger;

class ApiMaker
{
    private mixed $cmd;

    public function __construct()
    {
        global $argv;
        $this->cmd = $argv;
    }

    public function createApi(): void
    {
        if (!isset($this->cmd[2])) {
            Logger::status('Warning', 'Enter the Api name!', 'warning');
            return;
        }

        $apiPage = str_replace('&&&', $this->cmd[2], file_get_contents('Core/Cli/Layout/api.txt'));

        $fileName = 'App/Controller/Api/' . $this->cmd[2] . '.php';
        if (file_exists($fileName)) {
            Logger::warning('Api is already exist!');
        } else {
            file_put_contents($fileName, $apiPage);
            Logger::success('Api Created Successfully!');
        }
    }

    public function removeApi(): void
    {
        if (!isset($this->cmd[2])) {
            Logger::status('Warning', 'Enter the Api name!', 'warning');
            return;
        }

        if (file_exists("App/Controller/Api/{$this->cmd[2]}.php")) {
            unlink("App/Controller/Api/{$this->cmd[2]}.php");
            Logger::status('Success', 'Api deleted successfully!');
        } else {
            Logger::status('Failed', 'Api is not exist!', 'failed');
        }
    }
}