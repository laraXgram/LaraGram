<?php

namespace LaraGram\Core\Cli\Action;

use LaraGram\Core\Cli\Error\Logger;
use LaraGram\Core\Connect\Mysql;
use LaraGram\Core\Database\Migration;

class DatabaseMaker
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
            Logger::warning('Enter the Model name!', true);
        }

        $modelPage = str_replace('&&&', $this->cmd[2], file_get_contents('Core/Cli/Layout/mysqlModel.txt'));
        $fileName = 'App/Model/' . $this->cmd[2] . '.php';
        if (file_exists($fileName)) {
            Logger::warning('Model is already exist!');
        } else {
            file_put_contents($fileName, $modelPage);
            Logger::success('Model Created Successfully!');
        }
    }

    public function removeModel(): void
    {
        if (!isset($this->cmd[2])) {
            Logger::warning('Enter the Model name!', true);
        }

        $name = ucfirst($this->cmd[2]);

        if (file_exists("App/Model/{$name}.php")) {
            unlink("App/Model/{$name}.php");
            Logger::success('Model deleted successfully!');
        } else {
            Logger::failed('Model is not exist!', true);
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
                $migrationPage = str_replace('&&&', $part[1], file_get_contents('Core/Cli/Layout/createMigrations.txt'));
            } elseif ($part[0] === '--table') {
                $migrationPage = str_replace('&&&', $part[1], file_get_contents('Core/Cli/Layout/tableMigrations.txt'));
            }
        } else {
            Logger::failed("Please Set Migration Option [--create=<tableName> Or --table=<tableName>]", true);
        }

        $fileName = 'Database/Mysql/Migrations/' . date('Y_m_d_U') . '_' . $this->cmd[2] . '.php';
        file_put_contents($fileName, $migrationPage);
        Logger::success('Migration Created Successfully!');
    }

    private function needMigrate(): array|null
    {
        $lastMigrationsInDb = Migration::all()->toArray();
        $batch = [];
        foreach ($lastMigrationsInDb as $lastMigrationInDb) {
            $batch[] = $lastMigrationInDb['batch'];
            $lastMigrations[] = $lastMigrationInDb['migration'];
        }

        $existMigrationsInFolder = scandir('Database/Mysql/Migrations');
        foreach ($existMigrationsInFolder as $existMigrationInFolder) {
            if ($existMigrationInFolder[0] !== '.') {
                $existMigrations[] = $existMigrationInFolder;
            }
        }

        $existMigrations = array_map(function ($value) {
            return str_replace('.php', '', $value);
        }, $existMigrations);

        $needToMigrate = [];

        if (isset($lastMigrations) && isset($existMigrations) && count($lastMigrations) === count($existMigrations)) {
            return null;
        } else if (isset($lastMigrations) && count($lastMigrations) !== count($existMigrations)) {
            foreach ($existMigrations as $existMigration) {
                if (!in_array($existMigration, $lastMigrations)) {
                    $needToMigrate[] = $existMigration;
                }
            }

            $this->batch = max($batch);
        } else {
            foreach ($existMigrations as $existMigration) {
                $needToMigrate[] = $existMigration;
            }

            $this->batch = 0;
        }

        return $needToMigrate;
    }

    private function addToMigrations(string $name, int $batch): void
    {
        $migration = new Migration();
        $migration->migration = $name;
        $migration->batch = $batch;
        $migration->save();
    }

    public function migrate(): void
    {
        (new Mysql())->create_migrations_table();

        $needMigrate = $this->needMigrate();
        if (is_null($needMigrate)) {
            Logger::failed('Nothing to Migrate!');
            exit();
        }

        foreach ($needMigrate as $migrate) {
            $class = require_once "Database/Mysql/Migrations/{$migrate}.php";
            $class->up();
            $this->addToMigrations($migrate, $this->batch + 1);
            Logger::success("Migrated: {$migrate}");
        }
    }
}