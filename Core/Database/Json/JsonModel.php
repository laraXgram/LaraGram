<?php

namespace Bot\Core\Database\Json;

use Bot\Core\Cli\Error\Logger;
use Exception;

class JsonModel
{
    private array $select = [];
    private int $select_statement = 0;
    private array $schema = [];
    // ---------------------------
    protected string $database = '';
    protected array $fillable = [];
    protected array $guarded = [];

    public function __construct()
    {
        if (!isset($self->database)) {
            $database = explode('\\', get_called_class());
            $this->database = $database[array_key_last($database)];
        }
        $this->schema = json_decode(file_get_contents(getcwd() . "\Core\Database\Json\schema.json"), true)[$this->database];
    }

    private function largeArrayGenerator($largeArray)
    {
        foreach ($largeArray as $key => $value) {
            yield $key => $value;
        }
    }

    private function isUnique($keyToCheck, $array1, $array2) {
        $result = [];
        $array2Result= array_reduce(explode('.', $keyToCheck), function ($carry, $key) {
            if (isset($carry[$key])){
                return $carry[$key];
            }
        }, $array2);
        foreach ($array1 as $item) {
            $array1Result= array_reduce(explode('.', $keyToCheck), function ($carry, $key) {
                return $carry[$key];
            }, $item);
            $result[] = $array1Result;
        }

        if (!in_array($array2Result, $result)) {
            return true;
        }else{
            return false;
        }
    }

    private function generateStructure($data)
    {
        $jsonArray = $this->schema;
        $autoIncrement = $jsonArray['auto_increment'];
        $structure = $jsonArray['structure'];

        $result = [];

        foreach ($structure as $key => $attributes) {
            $keys = explode('.', $key);
            $current = &$result;

            foreach ($keys as $nestedKey) {
                if (!isset($current[$nestedKey])) {
                    $current[$nestedKey] = [];
                }

                $current = &$current[$nestedKey];
            }
            $current = $attributes['default'];
        }

        if (isset($autoIncrement['key']) && isset($result[$autoIncrement['key']])) {
            $result[$autoIncrement['key']] = $autoIncrement['next'];
            $this->schema['auto_increment']['next']++;
        }

        foreach ($structure as $key => $properties) {
            if ($properties['nullable'] === false && $key != $jsonArray['auto_increment']['key'] && !in_array($key, $this->getAllKeys($data))) {
                die("$key is not nullable");
            }

            if ($properties['unique'] === true && !$this->isUnique($key, $this->largeArrayGenerator($this->getDataFromDb()), $data)) {
                die("$key is unique");
            }
        }

        return $this->mergeArraysBasedOnStructure($result, $data, $this->getAllKeys($data));
    }

    public function mergeArraysBasedOnStructure($array1, $array2, $dataKeys, $prefix = '')
    {
        $result = $array1;
        $schema = $this->schema;
        $structure = $schema['structure'];

        foreach ($array2 as $key => $value) {
            if (isset($array1[$key])) {
                $ruleKey = $prefix != '' ? "$prefix.$key" : $key;
                $rules = $structure[$ruleKey];
                if ($rules['type'] == gettype($value) || $rules['type'] == '') {
                    if (is_array($value) && is_array($array1[$key])) {
                        $prefix == '' ? $prefix .= $key : $prefix .= '.' . $key;
                        $result[$key] = $this->mergeArraysBasedOnStructure($array1[$key], $value, $dataKeys, $prefix);
                    } else {
                        $result[$key] = $value;
                    }
                } else {
                    die("$key is not a {$rules['type']}");
                }
            } else {
                die("$key is not a field");
            }
        }

        return $result;
    }

    private function getDataFromDb()
    {
        $fileName = 'Database/Json/' . $this->database . '.json';
        return json_decode(file_get_contents($fileName), true);
    }

    private function getAllKeys($array, $prefix = ''): array
    {
        $result = [];
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $result[] = $key;
                $result = preg_replace('/[0-9]+\.|\.[0-9]+|\.[0-9]+\./', '', array_merge($result, $this->getAllKeys($value, $prefix . $key . '.')));
            } else {
                $result[] = preg_replace('/[0-9]+\.|\.[0-9]+|\.[0-9]+\./', '', $prefix . $key);;
            }
        }
        return $result;
    }

    private function isFillable(array $keys)
    {
        if (empty($this->fillable)) {
            return $keys[0];
        }
        foreach ($keys as $key) {
            if (!in_array($key, $this->fillable)) {
                return $key;
            }
        }
        return false;
    }

    private function isGuarded(array $key)
    {
        foreach ($this->guarded as $guarded) {
            if (in_array($guarded, $key)) {
                return $guarded;
            }
        }
        return false;
    }

    private function checkWriteAccess(array $keys): void
    {
        $isGuarded = $this->isGuarded($keys);
        if ($isGuarded) {
            Logger::status(
                "Field [ $isGuarded ] is guarded!",
                "The key [ $isGuarded ] is named as guarded field.",
                'failed',
                true
            );
        }

        $isFillable = $this->isFillable($keys);
        if ($isFillable) {
            Logger::status(
                "Field [ $isFillable ] is not fillable!",
                "The [ $isFillable ] key is not named as a fill field.",
                'failed',
                true
            );
        }
    }

    public function create(array $data, string|int $key = null): void
    {
//        exit();
        $this->checkWriteAccess($this->getAllKeys($data));

        $fileName = 'Database/Json/' . $this->database . '.json';
        $select = $this->getDataFromDb();
        $select[$key ?? (count($select ?? []) + 1)] = $this->generateStructure($data);

        file_put_contents($fileName, json_encode($select, 128 | 16));
    }

    public function delete(): bool
    {
        if ($this->select != null) {
            $data = $this->getDataFromDb();
            $selected = $this->get();
            foreach ($selected as $key => $value) {
                unset($data[$key]);
            }
            file_put_contents('Database/Json/' . $this->database . '.json', json_encode($data, 128 | 16));
            return true;
        } else {
            throw new Exception('delete method should be used after conditional methods', 705);
        }
    }

    public function update(string $key, mixed $new_data): bool
    {
        $this->checkWriteAccess([$key]);

        $keys = explode('.', $key);
        $array = $this->getDataFromDb();
        if ($this->select != null) {
            $selected = $this->get();
        } else {
            $selected = $this->all();
        }

        foreach ($selected as $k => $v) {
            $result = array_reduce($keys, function ($carry, $key) use ($new_data) {
                $carry[$key] = $new_data;
                return $carry;

            }, $v);
            $array[$k] = $result;
        }

        file_put_contents('Database/Json/' . $this->database . '.json', json_encode($array, 128 | 16));
        return true;
    }

    public function get(): array|null
    {
        if (!empty($this->select)) {
            foreach ($this->select as $statement) {
                if (count($statement) > 1) {
                    for ($i = 1; $i < count($statement); $i++) {
                        $commonValues[] = array_intersect($statement[0], $statement[$i]);
                    }
                } else {
                    $commonValues[] = $statement[0];
                }
            }
            $commonValues = array_unique(call_user_func_array('array_merge', $commonValues));
            $databaseData = $this->getDataFromDb();
            $data = [];
            foreach ($commonValues as $key) {
                $data[$key] = $databaseData[$key];
            }
            return $data;
        } else {
            throw new Exception('get method should be used after conditional methods', 705);
        }
    }

    public function all()
    {
        return $this->getDataFromDb();
    }

    public function first()
    {
        if ($this->select != null) {
            return $this->get()[array_key_first($this->get())];
        } else {
            return $this->all()[array_key_first($this->all())];
        }
    }

    public function where($key, $operator, $value): static
    {
        $keys = explode('.', $key);
        $founded = [];
        $array = $this->getDataFromDb();

        foreach ($array as $key => $data) {
            $result = array_reduce($keys, function ($carry, $key) {
                return $carry[$key];
            }, $data);

            $match = match ($operator) {
                '=', '==' => $result == $value,
                '===' => $result === $value,
                '!===' => $result !== $value,
                '!=' => $result != $value,
                '<' => $result < $value,
                '<=' => $result <= $value,
                '>' => $result > $value,
                '>=' => $result >= $value,
            };
            if ($match) {
                $founded[] = $key;
            }

        }
        $this->select[$this->select_statement][] = $founded;

        return $this;
    }

    public function orWhere($key, $operator, $value): static
    {
        $this->select_statement++;

        $keys = explode('.', $key);
        $founded = [];
        $array = $this->getDataFromDb();

        foreach ($array as $key => $data) {
            $result = array_reduce($keys, function ($carry, $key) {
                if (isset($carry[$key])) {
                    return $carry[$key];
                }
            }, $data);

            if ($result != null) {
                $match = match ($operator) {
                    '=', '==' => $result == $value,
                    '===' => $result === $value,
                    '!===' => $result !== $value,
                    '!=' => $result != $value,
                    '<' => $result < $value,
                    '<=' => $result <= $value,
                    '>' => $result > $value,
                    '>=' => $result >= $value,
                };
                if ($match) {
                    $founded[] = $key;
                }
            }
        }
        $this->select[$this->select_statement][] = $founded;

        return $this;
    }

    public function truncate(): bool
    {
        file_put_contents('Database/Json/' . $this->database . '.json', "{\n\n}");
        return true;
    }

    public function rowCount(): int
    {
        return count($this->all());
    }

    public function count(): int
    {
        return count($this->get());
    }

    public function empty($key): bool
    {
        return $this->update($key, '');
    }

    public function updateKey($key, $newKey)
    {

    }

    public function __destruct()
    {
        $schema = json_decode(file_get_contents(getcwd() . "\Core\Database\Json\schema.json"), true);
        $schema[$this->database] = $this->schema;
        file_put_contents(getcwd() . "\Core\Database\Json\schema.json", json_encode($schema, 128));
    }
}