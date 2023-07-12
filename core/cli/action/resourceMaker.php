<?php

namespace Bot\Core\Cli\Action;

use Bot\Core\Cli\Error\Logger;

class ResourceMaker
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
            Logger::status('Warning', 'Enter the Resource name!', 'warning');
            return;
        }

        $data = json_decode(file_get_contents('bootstrap/load.json'), true);
        if (!in_array("app/resources/{$this->cmd[2]}.php", $data) && !file_exists("app/resources/{$this->cmd[2]}.php")) {
            $data[$this->cmd[2]] = "app/resources/{$this->cmd[2]}.php";
            $data = json_encode($data, JSON_FORCE_OBJECT | JSON_PRETTY_PRINT);
            $data = str_replace('\\', '', $data);
            file_put_contents('bootstrap/load.json', $data);
            file_put_contents("app/resources/{$this->cmd[2]}.php", file_get_contents('core/cli/layout/resource.txt'));
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

        $data = json_decode(file_get_contents('bootstrap/load.json'), true);
        if (in_array("app/resources/{$this->cmd[2]}.php", $data) && file_exists("app/resources/{$this->cmd[2]}.php")) {
            unlink("app/resources/{$this->cmd[2]}.php");
            unset($data[$this->cmd[2]]);
            $data = json_encode($data, JSON_FORCE_OBJECT | JSON_PRETTY_PRINT);
            $data = str_replace('\\', '', $data);
            file_put_contents('bootstrap/load.json', $data);
            Logger::status('Success', 'Resource deleted successfully!');
        } else {
            Logger::status('Failed', 'Resource is not exist!', 'failed');
        }
    }
}