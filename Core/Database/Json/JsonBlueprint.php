<?php

namespace LaraGram\Core\Database\Json;

use LaraGram\Core\Cli\Error\Logger;

class JsonBlueprint
{
    private array $schema = [
        'auto_increment' => [
            'key' => '',
            'next' => 1
        ],
        'structure' => [

        ]
    ];

    private string $currentKey = '';

    private function addColumn(string $type, string $name)
    {
        $this->currentKey = $name;
        $this->schema['structure'][$name]['type']     = $type;
        $this->schema['structure'][$name]['unique']   = false;
        $this->schema['structure'][$name]['default']  = '';
        $this->schema['structure'][$name]['nullable'] = false;
    }

    public function integer(string $name)
    {
        $this->addColumn('integer', $name);
        return $this;
    }

    public function string(string $name)
    {
        $this->addColumn('string', $name);
        return $this;
    }

    public function array(string $name)
    {
        $this->addColumn('array', $name);
        return $this;
    }

    public function boolean(string $name)
    {
        $this->addColumn('boolean', $name);
        return $this;
    }

    public function double(string $name)
    {
        $this->addColumn('double', $name);
        return $this;
    }

    public function object(string $name)
    {
        $this->addColumn('object', $name);
        return $this;
    }

    public function any(string $name)
    {
        $this->addColumn('', $name);
        return $this;
    }

    public function unique()
    {
        $this->schema['structure'][$this->currentKey]['unique'] = true;
        return $this;
    }

    public function default(mixed $default)
    {
        $this->schema['structure'][$this->currentKey]['default'] = $default;
        return $this;
    }

    public function nullable()
    {
        $this->schema['structure'][$this->currentKey]['nullable'] = true;
        return $this;
    }

    public function autoIncrement(int $start = 1)
    {
        if ($this->schema['structure'][$this->currentKey]['type'] == 'integer') {
            $this->schema['auto_increment']['key'] = $this->currentKey;
            $this->schema['auto_increment']['next'] = $start;
            $this->schema['structure'][$this->currentKey]['unique'] = true;
            $this->schema['structure'][$this->currentKey]['nullable'] = false;
            var_dump($this->schema);
        } else{
            Logger::warning("column [ $this->currentKey ] must be integer!", true);
        }

        return $this;
    }

    public function getSchema()
    {
        return $this->schema;
    }
}