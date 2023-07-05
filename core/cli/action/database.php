<?php

namespace Bot\Core\Cli\Action;

use Bot\Core\Cli\Error\Logger;

class Database
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

        if (!isset($this->cmd[3]) || @$this->cmd[3] == '--mysql') {
            $this->createMysqlModel();
        }
    }

    public function createMigration(): void
    {
        if (!isset($this->cmd[2])) {
            Logger::status('Warning', 'Enter the Migration name!', 'warning');
            return;
        }

        if (!isset($this->cmd[3]) || @$this->cmd[3] == '--mysql') {
            $this->createMysqlMigrations();
        }
    }

    private function createMysqlModel(): void
    {
        $migrationPage = str_replace('&&&', $this->cmd[2], file_get_contents('core/cli/layout/mysqlModel.txt'));
        $fileName = 'database/mysql/model/' . $this->cmd[2] . '.php';
        if (file_exists($fileName)) {
            Logger::warning('Model is already exist!');
        } else {
            file_put_contents($fileName, $migrationPage);
            Logger::success('Mysql Model Created Successfully!');
        }
    }

    private function createMysqlMigrations(): void
    {
        $migrationPage = str_replace('&&&', $this->cmd[2], file_get_contents('core/cli/layout/mysqlMigrations.txt'));
        $fileName = 'database/mysql/migrations/' . $this->cmd[2] . '.php';
        if (file_exists($fileName)) {
            Logger::warning('Migration is already exist!');
        } else {
            file_put_contents($fileName, $migrationPage);
            Logger::success('Mysql Migration Created Successfully!');
        }
    }
}