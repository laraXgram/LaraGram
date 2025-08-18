<?php

$server = escapeshellarg(json_encode($_SERVER));
$inputs = escapeshellarg(file_get_contents('php://input'));

$vendorDir = realpath(__DIR__ . '/../vendor'); // Change this if the vendor location changes.
$serverPath = $vendorDir . '/laraxgram/core/src/Foundation/resources/server.php';

$output = '/dev/null'; // You can change it to specifics file.

popen("php \"{$serverPath}\" {$inputs} {$server} >> {$output} 2>&1 &", "r");
