<?php

use Bot\Core\Bot;
use Bot\Core\Request;

$bot = new Bot();

$bot->on('hello', function (Request $request){
    $request->sendMessage([
        'chat_id' => $request->ChatID(),
        'text'    => 'hi'
    ], 128);
});