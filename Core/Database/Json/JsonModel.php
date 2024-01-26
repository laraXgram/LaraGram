<?php

namespace Bot\Core\Database\Json;

use Exception;

class JsonModel
{
    private const JSON_OPTIONS = JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES;
    private array $select = [];
    private int $select_statement = 0;
    private array $schema = [];
    private ?array $dataCache = null;
    private ?array $newData = [];
    private bool $newDataCreated = true;
    private bool $schemaChanged = false;
    private string $filePath;
    private string $schemaPath;
    // ---------------------------
    protected string $database = '';
    protected array $fillable = [];
    protected array $guarded = [];

    public function __construct()
    {
        $this->initializePaths();
        $this->loadSchema();
        $this->loadData();
    }

    public function __destruct()
    {
        $this->saveSchemaIfNeeded();
        if ($this->newDataCreated) {
            $this->saveDataToDb();
            $this->newDataCreated = false;
        }
    }

    private function initializePaths()
    {
        if ($this->database === '') {
            $this->database = $this->inferDatabaseName();
        }
        $this->filePath = 'Database/Json/' . $this->database . '.json';
        $this->schemaPath = getcwd() . "/Core/Database/Json/schema.json";
    }

    private function inferDatabaseName()
    {
        $database = explode('\\', get_called_class());
        return $database[array_key_last($database)];
    }

    private function loadSchema()
    {
        if (!file_exists($this->schemaPath)) {
            throw new Exception("Schema file does not exist");
        }
        $this->schema = json_decode(file_get_contents($this->schemaPath), true) ?? [];
    }

    private function saveSchemaIfNeeded()
    {
        if ($this->schemaChanged) {
            file_put_contents($this->schemaPath, json_encode($this->schema, self::JSON_OPTIONS));
            $this->schemaChanged = false;
        }
    }

    private function largeArrayGenerator($largeArray)
    {
        foreach ($largeArray as $key => $value) {
            yield $key => $value;
        }
    }

    private function isUnique($keyToCheck, $array1, $array2)
    {
        $keys = explode('.', $keyToCheck);
        $array2Value = $array2;
        foreach ($keys as $key) {
            $array2Value = $array2Value[$key] ?? null;
        }

        foreach ($array1 as $item) {
            $itemValue = $item;
            foreach ($keys as $key) {
                $itemValue = $itemValue[$key] ?? null;
            }
            if ($itemValue === $array2Value) {
                return false;
            }
        }
        return true;
    }

    private function generateStructure($data)
    {
        $jsonArray = $this->schema[$this->database];
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
            $this->schema[$this->database]['auto_increment']['next']++;
        }

        foreach ($structure as $key => $properties) {
            if ($properties['nullable'] === false && $key != $jsonArray['auto_increment']['key'] && !in_array($key, $this->getAllKeys($data))) {
                die("$key is not nullable");
            }

            if ($properties['unique'] === true && !$this->isUnique($key, $this->largeArrayGenerator($this->dataCache), $data)) {
                die("$key is unique");
            }
        }

        return $this->mergeArraysBasedOnStructure($result, $data, $this->getAllKeys($data));
    }

    public function mergeArraysBasedOnStructure($array1, $array2, $dataKeys, $prefix = '')
    {
        $result = $array1;
        $schema = $this->schema[$this->database];
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

    private function loadData()
    {
        if ($this->dataCache === null) {
            if (!file_exists($this->filePath)) {
                throw new Exception("Data file does not exist");
            }
            $this->dataCache = json_decode(file_get_contents($this->filePath), true) ?? [];
        }
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
            throw new Exception("Field [ $isGuarded ] is guarded!");
        }

        $isFillable = $this->isFillable($keys);
        if ($isFillable) {
            throw new Exception("Field [ $isFillable ] is not fillable!");
        }
    }

    private function saveDataToDb(): void
    {
        if ($this->newData !== null) {
            $data = array_merge($this->dataCache, $this->newData);
            file_put_contents($this->filePath, json_encode($data, self::JSON_OPTIONS));
            $this->newData = [];
            $this->newDataCreated = false;
        }
    }

    private function applyCondition($key, $operator, $value, $isOrCondition)
    {
        if ($isOrCondition) {
            $this->select_statement++;
        }

        $keys = explode('.', $key);
        $founded = [];
        $array = $this->dataCache;

        foreach ($array as $arrayKey => $data) {
            $result = $data;
            foreach ($keys as $nestedKey) {
                $result = $result[$nestedKey] ?? null;
            }

            $match = match ($operator) {
                '=', '==' => $result == $value,
                '===' => $result === $value,
                '!==' => $result !== $value,
                '!=' => $result != $value,
                '<' => $result < $value,
                '<=' => $result <= $value,
                '>' => $result > $value,
                '>=' => $result >= $value,
                default => throw new Exception("Invalid operator: $operator")
            };

            if ($match) {
                $founded[] = $arrayKey;
            }
        }

        $this->select[$this->select_statement][] = $founded;
    }

    public function create(array $data, bool $forceWrite = false): void
    {
        $this->checkWriteAccess($this->getAllKeys($data));

        $this->schemaChanged = true;
        $this->newData[(count($this->dataCache ?? [])) + (count($this->newData ?? []) + 1)] = $this->generateStructure($data);
        $this->newDataCreated = true;
        if ($forceWrite) {
            $this->saveDataToDb();
        }
    }

    public function delete(): bool
    {
        if (!empty($this->select)) {
            $selected = $this->get();
            foreach ($selected as $key => $value) {
                unset($this->dataCache[$key]);
            }
            $this->saveDataToDb();
            return true;
        } else {
            throw new Exception('Delete method should be used after conditional methods', 705);
        }
    }

    public function update(string $key, mixed $new_data): bool
    {
        $this->checkWriteAccess([$key]);

        $keys = explode('.', $key);
        if ($this->select != null) {
            $selected = $this->get();
        } else {
            $selected = $this->all();
        }

        foreach ($selected as $k => $v) {
            $result = &$this->dataCache[$k];
            foreach ($keys as $nestedKey) {
                if (!isset($result[$nestedKey])) {
                    throw new Exception("Invalid key: $nestedKey");
                }
                $result = &$result[$nestedKey];
            }
            $result = $new_data;
        }

        $this->saveDataToDb();
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
            $databaseData = $this->dataCache;
            $data = [];
            foreach ($commonValues as $key) {
                $data[$key] = $databaseData[$key];
            }
            $this->select_statement = 0;
            return $data;
        } else {
            throw new Exception('get method should be used after conditional methods', 705);
        }
    }

    public function all()
    {
        return $this->dataCache;
    }

    public function first()
    {
        if ($this->select != null) {
            return $this->get()[array_key_first($this->get())];
        } else {
            return $this->dataCache[array_key_first($this->all())];
        }
    }

    public function where($key, $operator, $value): static
    {
        $this->applyCondition($key, $operator, $value, false);
        return $this;
    }

    public function orWhere($key, $operator, $value): static
    {
        $this->applyCondition($key, $operator, $value, true);
        return $this;
    }

    public function truncate(): bool
    {
        file_put_contents('Database/Json/' . $this->database . '.json', "{\n\n}");
        return true;
    }

    public function rowCount(): int
    {
        return count($this->dataCache);
    }

    public function count(): int
    {
        return count($this->get());
    }

    public function empty($key): bool
    {
        return $this->update($key, '');
    }
}