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
        $pay = '',
        $request_user = '',
        $request_chat = '',
        $request_contact = '',
        $request_location = '',
        $request_poll = ''
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
        } elseif ($request_user != '') {
            $replyMarkup['request_user'] = $request_user;
        } elseif ($request_chat != '') {
            $replyMarkup['request_chat'] = $request_chat;
        } elseif ($request_contact != '') {
            $replyMarkup['request_contact'] = $request_contact;
        } elseif ($request_location != '') {
            $replyMarkup['request_location'] = $request_location;
        } elseif ($request_poll != '') {
            $replyMarkup['request_poll'] = $request_poll;
        }
        return $replyMarkup;
    }
}