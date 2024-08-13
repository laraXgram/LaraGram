<?php

require_once 'vendor/autoload.php';

global $data;
$data['argv'] = $argv ?? [];

(new \LaraGram\Foundation\Application())
    ->handleRequests();