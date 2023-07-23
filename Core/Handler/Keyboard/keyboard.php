<?php

namespace Bot\Core\Handler\Keyboard;

require_once 'make.php';
require_once 'inlineKeyboardMarkup.php';

class Keyboard
{
    public static function foreReply()
    {

    }

    public static function replyKeyboardRemove()
    {

    }

    public static function replyKeyboardMarkup()
    {

    }

    public static function inlineKeyboardMarkup(...$row): bool|string
    {
        return json_encode([
            'inline_keyboard' => $row
        ]);
    }
}