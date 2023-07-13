<?php

namespace Bot\Core\Database;

use Bot\Core\Interface\SchemaInterface;
use Closure;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Connection;

class Schema implements SchemaInterface
{
    public static function hasTable(string $table): bool
    {
        return Capsule::schema()->hasTable($table);
    }

    public static function table(string $table, Closure $callback)
    {
        // TODO: Implement table() method.
    }

    public static function create(string $table, Closure $callback)
    {
        Capsule::schema()->create($table, $callback);
    }

    public static function blueprintResolver(Closure $resolver)
    {
        // TODO: Implement blueprintResolver() method.
    }

    public static function createDatabase(string $name)
    {
        // TODO: Implement createDatabase() method.
    }

    public static function disableForeignKeyConstraints()
    {
        // TODO: Implement disableForeignKeyConstraints() method.
    }

    public static function drop(string $table)
    {
        // TODO: Implement drop() method.
    }

    public static function dropAllTables()
    {
        // TODO: Implement dropAllTables() method.
    }

    public static function dropAllTypes()
    {
        // TODO: Implement dropAllTypes() method.
    }

    public static function dropAllViews()
    {
        // TODO: Implement dropAllViews() method.
    }

    public static function dropColumns(string $name, array|string $columns)
    {
        // TODO: Implement dropColumns() method.
    }

    public static function dropDatabaseIfExists(string $name)
    {
        // TODO: Implement dropDatabaseIfExists() method.
    }

    public static function dropIfExists(string $table)
    {
        // TODO: Implement dropIfExists() method.
    }

    public static function enableForeignKeyConstraints()
    {
        // TODO: Implement enableForeignKeyConstraints() method.
    }

    public static function getAllTables()
    {
        // TODO: Implement getAllTables() method.
    }

    public static function getColumnListing(string $table)
    {
        // TODO: Implement getColumnListing() method.
    }

    public static function getColumnType(string $table, string $column)
    {
        // TODO: Implement getColumnType() method.
    }

    public static function getConnection($table_name)
    {
        // TODO: Implement getConnection() method.
    }

    public static function hasColumn(string $table, string $column)
    {
        // TODO: Implement hasColumn() method.
    }

    public static function hasColumns(string $table, array $columns)
    {
        // TODO: Implement hasColumns() method.
    }

    public static function rename(string $from, string $to)
    {
        // TODO: Implement rename() method.
    }

    public static function setConnection(Connection $connection)
    {
        // TODO: Implement setConnection() method.
    }

    public static function whenTableDoesntHaveColumn(string $table, string $column, Closure $callback)
    {
        // TODO: Implement whenTableDoesntHaveColumn() method.
    }

    public static function withoutForeignKeyConstraints(Closure $callback)
    {
        // TODO: Implement withoutForeignKeyConstraints() method.
    }

    public static function whenTableHasColumn(string $table, string $column, Closure $callback)
    {
        // TODO: Implement whenTableHasColumn() method.
    }
}