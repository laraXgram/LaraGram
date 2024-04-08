<?php

namespace LaraGram\Core\Conversation;

use LaraGram\Core\Handler\Keyboard\Keyboard;

class Maker
{
    public function type(string $types)
    {
        return $this;
    }

    public function name(string $name){
        return $this;
    }

    public function keyboard(Keyboard $keyboard)
    {
        return $this;
    }

    public function media(string $type, string $file_id)
    {
        return $this;
    }

    public function skipCommand(string $command)
    {
        return $this;
    }

    public function action(callable $action)
    {
        return $this;
    }
}