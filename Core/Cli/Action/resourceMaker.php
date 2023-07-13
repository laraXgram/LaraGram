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

        $data = json_decode(file_get_contents('Bootstrap/load.json'), true);
        if (!in_array("App/Resources/{$this->cmd[2]}.php", $data) && !file_exists("App/Resources/{$this->cmd[2]}.php")) {
            $data[$this->cmd[2]] = "App/Resources/{$this->cmd[2]}.php";
            $data = json_encode($data, JSON_FORCE_OBJECT | JSON_PRETTY_PRINT);
            $data = str_replace('\\', '', $data);
            file_put_contents('Bootstrap/load.json', $data);
            file_put_contents("App/Resources/{$this->cmd[2]}.php", file_get_contents('Core/Cli/Layout/resource.txt'));
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

        $data = json_decode(file_get_contents('Bootstrap/load.json'), true);
        if (in_array("App/Resources/{$this->cmd[2]}.php", $data) && file_exists("App/Resources/{$this->cmd[2]}.php")) {
            unlink("App/Resources/{$this->cmd[2]}.php");
            unset($data[$this->cmd[2]]);
            $data = json_encode($data, JSON_FORCE_OBJECT | JSON_PRETTY_PRINT);
            $data = str_replace('\\', '', $data);
            file_put_contents('Bootstrap/load.json', $data);
            Logger::status('Success', 'Resource deleted successfully!');
        } else {
            Logger::status('Failed', 'Resource is not exist!', 'failed');
        }
    }
}