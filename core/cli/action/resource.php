<?php

namespace Bot\Core\Cli\Action;

use Bot\Core\Cli\Error\Logger;

class Resource
{
    private mixed $cmd;

    public function __construct()
    {
        global $argv;
        $this->cmd = $argv;
    }

    public function createResources(): void
    {
        if (!isset($this->cmd[2])) {
            Logger::warning('Warning');
            Logger::message('Enter the Resource name!');
            return;
        }

        $data = json_decode(file_get_contents('load.json'), true);
        if (!in_array("resources/{$this->cmd[2]}.php", $data) && !file_exists("resources/{$this->cmd[2]}.php")) {
            $data[$this->cmd[2]] = "resources/{$this->cmd[2]}.php";
            $data = json_encode($data, JSON_FORCE_OBJECT | JSON_PRETTY_PRINT);
            $data = str_replace('\\', '', $data);
            file_put_contents('load.json', $data);
            file_put_contents("resources/{$this->cmd[2]}.php", file_get_contents('core/cli/layout/resource.txt'));
            Logger::status('Success', 'Resource created successfully!');
        } else {
            Logger::status('Failed', 'Resource is already exist!', 'failed');
        }
    }

    public function removeResources(): void
    {
        if (!isset($this->cmd[2])) {
            Logger::status('Warning', 'Enter the Resource name!', 'warning');
            return;
        }

        $data = json_decode(file_get_contents('load.json'), true);
        if (in_array("resources/{$this->cmd[2]}.php", $data) && file_exists("resources/{$this->cmd[2]}.php")) {
            unlink("resources/{$this->cmd[2]}.php");
            unset($data[$this->cmd[2]]);
            $data = json_encode($data, JSON_FORCE_OBJECT | JSON_PRETTY_PRINT);
            $data = str_replace('\\', '', $data);
            file_put_contents('load.json', $data);
            Logger::status('Success', 'Resource deleted successfully!');
        } else {
            Logger::status('Failed', 'Resource is not exist!', 'failed');
        }
    }
}