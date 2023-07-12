<?php

namespace Bot\Core\Cli\Action;

use Bot\Core\Cli\Error\Logger;

class DatabaseMaker
{
    private mixed $cmd;

    public function __construct()
    {
        global $argv;
        $this->cmd = $argv;
    }

    public function createModel(): void
    {
        if (!isset($this->cmd[2])) {
            Logger::status('Warning', 'Enter the Model name!', 'warning');
            return;
        }

        $migrationPage = str_replace('&&&', $this->cmd[2], file_get_contents('core/cli/layout/mysqlModel.txt'));
        $fileName = 'app/model/' . $this->cmd[2] . '.php';
        if (file_exists($fileName)) {
            Logger::warning('Model is already exist!');
        } else {
            file_put_contents($fileName, $migrationPage);
            Logger::success('Mysql Model Created Successfully!');
        }
    }
}
