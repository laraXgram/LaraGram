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

$kernel->call('start:openswoole', function () {
    $server = new Server();
    $server->runOpenswoole();
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
$kernel->call('get:eloquent', function () {
    $server = new Installer();
    $server->install_Eloquent();
});

$kernel->call('remove:eloquent', function () {
    $server = new Installer();
    $server->uninstall_Eloquent();
});

$kernel->call('get:amphp', function () {
    $server = new Installer();
    $server->install_Amphp();
});

$kernel->call('remove:amphp', function () {
    $server = new Installer();
    $server->uninstall_Amphp();
});

$kernel->call('get:openswoole', function () {
    $server = new Installer();
    $server->install_Openswoole();
});

$kernel->call('remove:openswoole', function () {
    $server = new Installer();
    $server->uninstall_Openswoole();
});
//-----------------------------------------------------------------
$kernel->shutdown();