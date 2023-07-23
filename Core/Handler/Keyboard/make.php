<?php

namespace Bot\Core\Handler\Keyboard;

class Make
{
    public static function row(...$col): array
    {
        return [...$col];
    }

    public static function col(
        $text,
        $url = '',
        $callback_data = '',
        $web_app = '',
        $login_url = '',
        $switch_inline_query = null,
        $switch_inline_query_current_chat = null,
        $switch_inline_query_chosen_chat = null,
        $callback_game = '',
        $pay = ''
    ): array
    {
        $replyMarkup = [
            'text' => $text,
        ];

        if ($url != '') {
            $replyMarkup['url'] = $url;
        } elseif ($callback_data != '') {
            $replyMarkup['callback_data'] = $callback_data;
        } elseif ($web_app != '') {
            $replyMarkup['web_app'] = $web_app;
        } elseif ($login_url != '') {
            $replyMarkup['login_url'] = $login_url;
        } elseif (!is_null($switch_inline_query)) {
            $replyMarkup['switch_inline_query'] = $switch_inline_query;
        } elseif (!is_null($switch_inline_query_current_chat)) {
            $replyMarkup['switch_inline_query_current_chat'] = $switch_inline_query_current_chat;
        } elseif (!is_null($switch_inline_query_chosen_chat)) {
            $replyMarkup['switch_inline_query_chosen_chat'] = $switch_inline_query_chosen_chat;
        } elseif ($callback_game != '') {
            $replyMarkup['callback_game'] = $callback_game;
        } elseif ($pay != '') {
            $replyMarkup['pay'] = $pay;
        }
        return $replyMarkup;
    }
}