<?php

namespace Bot\Core\Cli\Action;

require_once 'bootstrap/bootstrap.php';

use Bot\Core\Cli\Kernel;

$kernel = new Kernel();
//-----------------------------------------------------------------
$kernel->call('make:model', function () {
    $database = new Database();
    $database->createModel();
});

$kernel->call('make:migration', function () {
    $database = new Database();
    $database->createMigration();
});
//-----------------------------------------------------------------
$kernel->call('make:resource', function () {
    $resource = new Resource();
    $resource->createResources();
});

$kernel->call('remove:resource', function () {
    $resource = new Resource();
    $resource->removeResources();
});
//-----------------------------------------------------------------
$kernel->call('serve', function () {
    $server = new Server();
    $server->serve();
});

$kernel->call('start:apiserver', function () {
    $server = new Server();
    $server->runApiServer();
});

$kernel->call('setWebhook', function () {
    $server = new Server();
    $server->setWebhook();
});

$kernel->call('deleteWebhook', function () {
    $server = new Server();
    $server->deleteWebhook();
});
//-----------------------------------------------------------------
$kernel->shutdown();