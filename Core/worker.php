<?php

global $datas;
$datas['argv'] = $argv;

require_once 'Bootstrap/bootstrap.php';

use Bot\Bootstrap\Runner;

Runner::start();
