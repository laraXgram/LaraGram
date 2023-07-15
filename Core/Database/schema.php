<?php

namespace Bot\Core\Database;

use Bot\Core\Interface\SchemaInterface;
use Closure;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Connection;
use Illuminate\Database\Schema\Builder;

class Schema implements SchemaInterface
{
    public static function hasTable(string $table): bool
    {
        return Capsule::schema()->hasTable($table);
    }

    public static function table(string $table, Closure $callback)
    {
        Capsule::schema()->table($table, $callback);
    }

    public static function create(string $table, Closure $callback)
    {
        Capsule::schema()->create($table, $callback);
    }

    public static function blueprintResolver(Closure $resolver)
    {
        Capsule::schema()->blueprintResolver($resolver);
    }

    public static function createDatabase(string $name): bool
    {
        return Capsule::schema()->createDatabase($name);
    }

    public static function disableForeignKeyConstraints(): bool
    {
        return Capsule::schema()->disableForeignKeyConstraints();
    }

    public static function drop(string $table)
    {
        Capsule::schema()->drop($table);
    }

    public static function dropAllTables()
    {
        Capsule::schema()->dropAllTables();
    }

    public static function dropAllTypes()
    {
        Capsule::schema()->dropAllTypes();
    }

    public static function dropAllViews()
    {
        Capsule::schema()->dropAllViews();
    }

    public static function dropColumns(string $name, array|string $columns)
    {
        Capsule::schema()->dropColumns($name, $columns);
    }

    public static function dropDatabaseIfExists(string $name): bool
    {
        return Capsule::schema()->dropDatabaseIfExists($name);
    }

    public static function dropIfExists(string $table)
    {
        Capsule::schema()->dropIfExists($table);
    }

    public static function enableForeignKeyConstraints(): bool
    {
        return Capsule::schema()->enableForeignKeyConstraints();
    }

    public static function getAllTables(): array
    {
        return Capsule::schema()->getAllTables();
    }

    public static function getColumnListing(string $table): array
    {
        return Capsule::schema()->getColumnListing($table);
    }

    public static function getColumnType(string $table, string $column): string
    {
        return Capsule::schema()->getColumnType($table, $column);
    }

    public static function getConnection(): Connection
    {
        return Capsule::schema()->getConnection();
    }

    public static function hasColumn(string $table, string $column): bool
    {
        return Capsule::schema()->hasColumn($table, $column);
    }

    public static function hasColumns(string $table, array $columns): bool
    {
        return Capsule::schema()->hasColumns($table, $columns);
    }

    public static function rename(string $from, string $to)
    {
        Capsule::schema()->rename($from, $to);
    }

    public static function setConnection(Connection $connection): Builder
    {
        return Capsule::schema()->setConnection($connection);
    }

    public static function whenTableDoesntHaveColumn(string $table, string $column, Closure $callback)
    {
        Capsule::schema()->whenTableDoesntHaveColumn($table, $column, $callback);
    }

    public static function withoutForeignKeyConstraints(Closure $callback): mixed
    {
        return Capsule::schema()->withoutForeignKeyConstraints($callback);
    }

    public static function whenTableHasColumn(string $table, string $column, Closure $callback)
    {
        Capsule::schema()->whenTableHasColumn($table, $column, $callback);
    }
}