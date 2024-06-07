<?php

use LaraGram\Core\Handler\Keyboard\Keyboard;
use LaraGram\Core\Handler\Keyboard\Make;

function inlineKeyboardMarkup(...$row)
{
    return Keyboard::inlineKeyboardMarkup($row);
}

function replyKeyboardMarkup(...$row)
{
    return Keyboard::replyKeyboardMarkup($row);
}

function col($text, $url = '', $callback_data = '', $web_app = '', $login_url = '', $switch_inline_query = null, $switch_inline_query_current_chat = null, $switch_inline_query_chosen_chat = null, $callback_game = '', $pay = '', $request_user = '', $request_chat = '', $request_contact = '', $request_location = '', $request_poll = '')
{
    return Make::col($text, $url, $callback_data, $web_app, $login_url, $switch_inline_query, $switch_inline_query_current_chat, $switch_inline_query_chosen_chat, $callback_game, $pay, $request_user, $request_chat, $request_contact, $request_location, $request_poll);
}

function row(...$col)
{
    return Make::row($col);
}