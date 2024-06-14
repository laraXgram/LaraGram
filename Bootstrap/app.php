<?php

use LaraGram\Foundation\Application;

require_once 'vendor/autoload.php';

global $data;
$data['argv'] = $argv;

new Application();