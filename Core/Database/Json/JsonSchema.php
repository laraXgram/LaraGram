<?php

namespace LaraGram\Core\Database\Json;

use Closure;

class JsonSchema
{
    private function mergeSchemas($array1, $array2) {
        foreach ($array2 as $key => $value) {
            if (!isset($array1[$key])) {
                $array1[$key] = $value;
            } else {
                if (is_array($value) && is_array($array1[$key])) {
                    $array1[$key] = $this->mergeSchemas($array1[$key], $value);
                }
            }
        }
        return $array1;
    }

    public static function hasTable(string $table): bool
    {
        return key_exists($table, json_decode(file_get_contents(getcwd() . "/Core/Database/Json/schema.json"), true));
    }

    public static function table(string $table, Closure $callback)
    {
        $schema = json_decode(file_get_contents(getcwd() . "/Core/Database/Json/schema.json"), true);
        $blueprint = new JsonBlueprint();
        $callback($blueprint);
        $oldSchema = $schema[$table];
        $newSchema = $blueprint->getSchema();
        $schema[$table] = (new self())->mergeSchemas($oldSchema, $newSchema);
        file_put_contents(getcwd() . "/Core/Database/Json/schema.json", json_encode($schema, 128 | 16));
        return true;
    }

    public static function create(string $table, Closure $callback)
    {
        $schema = json_decode(file_get_contents(getcwd() . "/Core/Database/Json/schema.json"), true);
        $blueprint = new JsonBlueprint();
        $callback($blueprint);
        $schema[$table] = $blueprint->getSchema();
        file_put_contents(getcwd() . "/Core/Database/Json/schema.json", json_encode($schema, 128 | 16));
        return true;
    }

    public static function drop(string $table)
    {
        $schema = json_decode(file_get_contents(getcwd() . "/Core/Database/Json/schema.json"), true);
        unset($schema[$table]);
        file_put_contents(getcwd() . "/Core/Database/Json/schema.json", json_encode($schema, 128 | 16));
        return true;
    }

    public static function dropAllTables()
    {
        file_put_contents(getcwd() . "/Core/Database/Json/schema.json", "{\n\n}");
        return true;
    }

    public static function dropColumns(string $table, array|string $columns)
    {
        // Soon
    }

    public static function dropIfExists(string $table)
    {
        // Soon
    }

    public static function getColumnListing(string $table)
    {
        // Soon
    }

    public static function getColumnType(string $table, string $column)
    {
        // Soon
    }

    public static function hasColumn(string $table, string $column)
    {
        // Soon
    }

    public static function hasColumns(string $table, array $columns)
    {
        // Soon
    }

    public static function rename(string $from, string $to)
    {
        // Soon
    }
}