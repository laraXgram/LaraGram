<?php

use Bot\Core\Bot;
use Bot\Core\Cli\Error\Log;
use Bot\Core\Cli\Error\Level;
use Bot\Core\Conversation\Questioner;
use Bot\Core\Request;

$bot = new Bot();


//$conversation = new Questioner();
//$conversation->addQuestion("What's your name?")->type('string|required')->name('name');
//$conversation->addQuestion("What's your phone number?")->type('phonenumber|required')->name('phonenumber');
//if ($conversation->ask()){
//    $answers = $conversation->getAnswers();
//    $data = "name is {$answers['name']} and phone number is {$answers['phonenumber']}";
//}

//Log::set('test', Level::Error, 'hello this is a test log from bot.php in resources file and this log level is Error. lets to see log result. good bye');
