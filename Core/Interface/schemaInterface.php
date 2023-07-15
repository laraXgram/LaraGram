<?php

namespace Bot\Core\Interface;

use Closure;
use Illuminate\Database\Connection;

interface SchemaInterface
{
    public static function hasTable(string $table);

    public static function table(string $table, Closure $callback);

    public static function create(string $table, Closure $callback);

    public static function blueprintResolver(Closure $resolver);

    public static function createDatabase(string $name);

    public static function disableForeignKeyConstraints();

    public static function drop(string $table);

    public static function dropAllTables();

    public static function dropAllTypes();

    public static function dropAllViews();

    public static function dropColumns(string $name, array|string $columns);

    public static function dropDatabaseIfExists(string $name);

    public static function dropIfExists(string $table);

    public static function enableForeignKeyConstraints();

    public static function getAllTables();

    public static function getColumnListing(string $table);

    public static function getColumnType(string $table, string $column);

    public static function getConnection();

    public static function hasColumn(string $table, string $column);

    public static function hasColumns(string $table, array $columns);

    public static function rename(string $from, string $to);

    public static function setConnection(Connection $connection);

    public static function whenTableDoesntHaveColumn(string $table, string $column, Closure $callback);

    public static function withoutForeignKeyConstraints(Closure $callback);

    public static function whenTableHasColumn(string $table, string $column, Closure $callback);
}