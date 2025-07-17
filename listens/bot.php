<?php

use LaraGram\Support\Facades\Bot;
use LaraGram\Request\Request;

Bot::onCommand('start', function (Request $request) {
    $request->sendMessage(chat()->id, "Hello LaraGram!");
});