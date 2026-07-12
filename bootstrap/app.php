<?php

use LaraGram\Foundation\Application;
use LaraGram\Foundation\Configuration\Exceptions;
use LaraGram\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withListener(
        bot: __DIR__."/../listens/bot.php",
        commands: __DIR__."/../listens/console.php",
    )
    ->withRouting(
        web: __DIR__."/../routes/web.php",
        health: '/health',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
