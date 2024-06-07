<?php

use LaraGram\Request\Request;
use LaraGram\Support\Facades\Bot;

Bot::onText('hello', function (Request $request) {
    $request->sendMessage($request->message->chat->id, 'hi LaraGram v2 is ready :)');
});

// Code ....