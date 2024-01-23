<?php

namespace Bot\Core\Database\Json;

use Exception;

class JsonModel
{
    private static $connect;
    private array $where = [];
    private array $or_where = [];
    // ---------------------------
    protected string $database;
    protected array $unique;
    protected string $autoIncrement;
    protected array $fillable;
    protected array $guarded;

    public static function connect(): JsonModel
    {
        if (self::$connect === null) {
            self::$connect = new JsonModel();
        }

        if (!isset($self->database)) {
            $database = explode('\\', get_called_class());
            self::$connect->database = $database[array_key_last($database)];
        }

        return self::$connect;
    }

    private function getDataFromDb()
    {
        $fileName = 'Database/Json/' . $this->database . '.json';
        return json_decode(file_get_contents($fileName), true);
    }

    public function create(array $data, string|int $key = null): void
    {
        $fileName = 'Database/Json/' . $this->database . '.json';
        $select = $this->getDataFromDb();
        $select[$key ?? (count($select ?? []) + 1)] = $data;

        file_put_contents($fileName, json_encode($select, JSON_PRETTY_PRINT | JSON_FORCE_OBJECT));
    }

    /**
     * @throws Exception
     */
    public function delete(): bool
    {
        if ($this->where != null) {
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
        return false;
    }

    public function update(string $key, mixed $new_data): bool
    {
        $keys = explode('.', $key);
        $array = $this->getDataFromDb();
        $selected = $this->get();

        foreach ($selected as $k => $v) {
            $result = array_reduce($keys, function ($carry, $key) use ($new_data) {
                if (key_exists($key, $carry)) {
                    $carry[$key] = $new_data;
                    return $carry;
                }
            }, $v);
            $array[$k] = $result;
        }

        file_put_contents('Database/Json/' . $this->database . '.json', json_encode($array, 128 | 16));
        return true;
    }

    /**
     * @throws Exception
     */
    public function get(): array|null
    {
        if ($this->where != null && $this->or_where == null) {
            $mainArray = $this->where;
            $commonValues = $mainArray[0];

            for ($i = 1; $i < count($mainArray); $i++) {
                $commonValues = array_intersect($commonValues, $mainArray[$i]);
            }

            $databaseData = $this->getDataFromDb();
            foreach ($commonValues as $key => $value) {
                $data[$value] = $databaseData[$value];
            }

            return $data ?? null;
        }

        if ($this->where != null && $this->or_where != null) {
            $whereArray = $this->where;
            $orWhereArray = $this->or_where;

            $mergedArray = array_merge($whereArray, $orWhereArray);
            $uniqueArray = array_unique(call_user_func_array('array_merge', $mergedArray));
            $flattenedArray = array_values($uniqueArray);

            $databaseData = $this->getDataFromDb();
            foreach ($flattenedArray as $key) {
                $data[$flattenedArray[$key - 1]] = $databaseData[$key];
            }

            return $data ?? null;
        }

        throw new Exception('get method should be used after conditional methods', 705);
    }

    public function all()
    {
        return $this->getDataFromDb();
    }

    /**
     * @throws Exception
     */
    public function first()
    {
        if ($this->where != null) {
            return $this->get()[array_key_first($this->get())];
        } else {
            throw new Exception('first method should be used after conditional methods', 705);
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
        $this->where[] = $founded;

        return $this;
    }

    public function orWhere($key, $operator, $value): static
    {
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
                    '=' => $result == $value,
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
        $this->or_where[] = $founded;


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

    public function count()
    {
        return count($this->get());
    }

    public function empty($key)
    {
        $this->update($key, '');
    }

    public function updateKey($key, $newKey) {

    }
}