<?php

namespace LaraGram\Core\Cli\Action;

use LaraGram\Core\Cli\Error\Logger;

class JsonDatabaseMaker
{
    private mixed $cmd;
    private int $batch;

    public function __construct()
    {
        global $argv;
        $this->cmd = $argv;
    }

    public function createModel(): void
    {
        if (!isset($this->cmd[2])) {
            Logger::warning('Enter the Json\'s Model name!', true);
        }

        $modelPage = str_replace('&&&', $this->cmd[2], file_get_contents('Core/Cli/Layout/jsonModel.txt'));
        $fileName = 'App/Model/Json/' . $this->cmd[2] . '.php';

        if (!file_exists('App/Model/Json')) {
            mkdir('App/Model/Json');
        }

        if (file_exists($fileName)) {
            Logger::warning('Json\'s Model is already exist!');
        } else {
            file_put_contents($fileName, $modelPage);
            Logger::success('Json\'s Model Created Successfully!');
        }
    }

    public function removeModel(): void
    {
        if (!isset($this->cmd[2])) {
            Logger::warning('Enter the Json\'s Model name!', true);
        }

        $fileName = "App/Model/Json/" . ucfirst($this->cmd[2]) . ".php";

        if (file_exists($fileName)) {
            unlink($fileName);
            Logger::status('Success', 'Json\'s Model deleted successfully!');
        } else {
            Logger::failed('Json\'s Model is not exist!', true);
        }
    }

    public function createDb(): void
    {
        if (!isset($this->cmd[2])) {
            Logger::warning('Enter the Json\'s Database name!', true);
        }

        $fileName = 'Database/Json/' . $this->cmd[2] . '.json';

        if (!file_exists('Database/Json')) {
            mkdir('Database/Json');
        }

        if (file_exists($fileName)) {
            Logger::warning('Json\'s Database is already exist!');
        } else {
            file_put_contents($fileName, "{\n\n}");
            Logger::success('Json\'s Database Created Successfully!');
        }
    }

    public function removeDb(): void
    {
        if (!isset($this->cmd[2])) {
            Logger::warning('Enter the Json\'s Database name!', true);
        }

        $fileName = 'Database/Json/' . ucfirst($this->cmd[2]) . '.json';

        if (file_exists($fileName)) {
            unlink($fileName);
            Logger::success('Json\'s Database deleted successfully!');
        } else {
            Logger::failed('Json\'s Database is not exist!', true);
        }
    }

    public function createMigrations(): void
    {
        if (!isset($this->cmd[2])) {
            Logger::warning('Enter the Migration name!', true);
        }

        if (isset($this->cmd[3])) {
            $part = explode('=', $this->cmd[3]);
            if ($part[0] === '--create') {
                $migrationPage = str_replace('&&&', $part[1], file_get_contents('Core/Cli/Layout/jsonCreateMigrations.txt'));
            } elseif ($part[0] === '--table') {
                $migrationPage = str_replace('&&&', $part[1], file_get_contents('Core/Cli/Layout/jsonTableMigrations.txt'));
            }
        } else {
            Logger::failed("Please Set Migration Option [--create=<tableName> Or --table=<tableName>]", true);
        }

        $fileName = 'Database/Json/Migrations/' . date('Y_m_d_U') . '_' . $this->cmd[2] . '.php';
        file_put_contents($fileName, $migrationPage);
        Logger::success('Migration Created Successfully!');
    }

    public function migrate(): void
    {
        $migrationFile = json_decode(file_get_contents(getcwd() . "/Core/Database/Json/migrations.json"), true);
        $migrationFile['batch']++;

        $migrationFolder = 'Database/Json/Migrations';
        $migrations = scandir($migrationFolder);
        $needed = [];
        $status = false;
        foreach ($migrations as $migration) {
            if ($migration[0] != '.' && !in_array($migration, $migrationFile['migrated'])) {
                $start = microtime(true);
                $class = require_once "Database/Json/Migrations/{$migration}";
                $class->up();
                $migrationFile['migrated'][] = $migration;
                $end = floor((microtime(true) - $start) * 1000);
                Logger::success("{$migration} Migrated! -> {$end}ms");
                $status = true;
            }
        }
        if (!$status) {
            Logger::warning("Nothing to migrate!");
        } else {
            file_put_contents(getcwd() . "/Core/Database/Json/migrations.json", json_encode($migrationFile, 128 | 16));
        }
    }
}