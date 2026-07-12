<?php

$serverPath = __DIR__."/../laraxgram/core/src/Foundation/resources/server.php";

$rawInput = file_get_contents('php://input');
$content = json_decode($rawInput, true);

$isBotUpdate = json_last_error() === JSON_ERROR_NONE
    && is_array($content)
    && array_key_exists('update_id', $content);

if ($isBotUpdate) {
    $server = escapeshellarg(json_encode($_SERVER));
    $inputs = escapeshellarg($rawInput);

    $log = "/dev/null";

    popen("php \"{$serverPath}\" {$inputs} {$server} >> {$log} 2>&1 &", "r");
} else {
    require_once $serverPath;
}
