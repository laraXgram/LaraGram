<?php

namespace Bot\Core\Database\Json;

use Exception;

class JsonModel
{
    private static $connect;
    private array $where = [];
    protected string $database;

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
        $fileName = '../../../Database/Json/' . $this->database . '.json';
        return json_decode(file_get_contents($fileName), true);
    }

    public function create(array $data, string|int $key = null): void
    {
        $fileName = '../../../Database/Json/' . $this->database . '.json';
        $select = $this->getDataFromDb();
        $select[$key ?? (count($select) + 1)] = $data;

        file_put_contents($fileName, json_encode($select, JSON_PRETTY_PRINT | JSON_FORCE_OBJECT));
    }

    /**
     * @throws Exception
     */
    public function delete(): bool
    {
        if ($this->where != null) {
            $uniqueValues = array_map('serialize', $this->where);
            $uniqueValues = array_unique($uniqueValues);
            $allArraysHaveSameValues = count($uniqueValues) === 1;

            if ($allArraysHaveSameValues) {
                $array = $this->getDataFromDb();
                for ($i = 0; $i < count($this->where[0]); $i++) {
                    unset($array[$this->where[0][$i]]);
                }

                file_put_contents('../../../Database/Json/' . $this->database . '.json', json_encode($array, 128|16));
                return true;
            }
        } else {
            throw new Exception('delete method should be used after conditional methods', 705);
        }
        return false;
    }

    protected function update()
    {

    }

    /**
     * @throws Exception
     */
    public function get(): array|null
    {
        if ($this->where != null) {
            $uniqueValues = array_map('serialize', $this->where);
            $uniqueValues = array_unique($uniqueValues);
            $allArraysHaveSameValues = count($uniqueValues) === 1;

            if ($allArraysHaveSameValues) {
                $array = $this->getDataFromDb();
                $data = [];
                for ($i = 0; $i < count($this->where[0]); $i++) {
                    $data[$this->where[0][$i]] = $array[$this->where[0][$i]];
                }
                return $data;
            }
        } else {
            throw new Exception('get method should be used after conditional methods', 705);
        }
        return null;
    }

    public function all()
    {
        return $this->getDataFromDb();
    }

    public function first()
    {
        if ($this->where != null) {
            return $this->get()[array_key_first($this->get())];
        } else {
            throw new Exception('first method should be used after conditional methods', 705);
        }
        return $this->get()[0];
    }

    public function where($key, $operator, $value): static
    {
        $keys = explode('.', $key);
        $founded = [];

        if ($this->where == []) {
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
            $this->where[] = $founded;
        } else {
            foreach ($this->where[0] as $index) {
                $data = $this->getDataFromDb()[$index];

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
                        $founded[] = $index;
                    }
                }
            }
            $this->where[] = $founded;
        }
        return $this;
    }

    public function orWhere($key, $operator, $value)
    {

    }

    public function truncate(): bool
    {
        file_put_contents('../../../Database/Json/' . $this->database . '.json', "{\n\n}");
        return true;
    }
}