<?php

global $datas;
$datas['argv'] = $argv;

require_once 'Bootstrap/Bootstrap.php';

use Bot\Bootstrap\Runner;

Runner::start();