<?php

global $datas;
$datas['argv'] = $argv;

require_once 'vendor/autoload.php';

use LaraGram\Core\Bootstrap\Bootstrap;

new Bootstrap();
Bootstrap::start();