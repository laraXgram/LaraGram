<?php

use Bot\Core\Bot;
use Bot\Core\Request;

$bot = new Bot();

// Code ...

$bot->on('hello', function (Request $request){
    $request->sendMessage([
        'chat_id' => $request->ChatID(),
        'text'    => 'hi'
    ], 32);
});
