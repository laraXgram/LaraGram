<?php

namespace LaraGram\Core\Handler\Keyboard;

class Keyboard
{
    public static function replyKeyboardMarkup(...$row): bool|string
    {
        return json_encode([
            'keyboard' => $row
        ]);
    }

    public static function inlineKeyboardMarkup(...$row): bool|string
    {
        return json_encode([
            'inline_keyboard' => $row
        ]);
    }
}