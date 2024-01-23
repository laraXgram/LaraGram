<?php

namespace Bot\Core\Database\Json;

use Bot\Core\Cli\Error\Logger;
use Exception;

class JsonModel
{
    private array $select = [];
    private int $select_statement = 0;
    // ---------------------------
    protected string $database = '';
    protected array $unique;
    protected string $autoIncrement;
    protected array $fillable = [];
    protected array $guarded = [];

    public function __construct()
    {
        if (!isset($self->database)) {
            $database = explode('\\', get_called_class());
            $this->database = $database[array_key_last($database)];
        }
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
            $newKey = ($prefix === '') ? $key : $prefix . '.' . $key;

            if (is_array($value)) {
                $result = preg_replace('/[0-9]+\.|\.[0-9]+|\.[0-9]+\./', '', array_merge($result, $this->getAllKeys($value, $newKey)));
            } else {
                $result[] = preg_replace('/[0-9]+\.|\.[0-9]+|\.[0-9]+\./', '', $newKey);
            }
        }

        return $result;
    }

    private function isFillable(array $key)
    {
        if (empty($this->fillable)) {
            return $key[0];
        }
        foreach ($this->fillable as $fillable) {
            if (!in_array($fillable, $key)) {
                return $fillable;
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
        $this->checkWriteAccess($this->getAllKeys($data));

        $fileName = 'Database/Json/' . $this->database . '.json';
        $select = $this->getDataFromDb();
        $select[$key ?? (count($select ?? []) + 1)] = $data;

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
//        $this->checkWriteAccess([$key]);

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
}