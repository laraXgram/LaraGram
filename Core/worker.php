<?php

global $datas;
$datas['argv'] = $argv;

require_once 'Bootstrap/Bootstrap.php';

use LaraGram\Bootstrap\Runner;

Runner::start();