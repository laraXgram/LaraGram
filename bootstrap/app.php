<?php

use LaraGram\Foundation\Application;
use LaraGram\Foundation\Configuration\Exceptions;

return Application::configure(basePath: dirname(__DIR__))
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->create();