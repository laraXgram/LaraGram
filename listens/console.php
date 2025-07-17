<?php

use LaraGram\Foundation\Inspiring;
use LaraGram\Support\Facades\Commander;

Commander::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');