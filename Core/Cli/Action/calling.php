<?php

namespace Bot\Core\Cli\Action;

require_once 'Bootstrap/bootstrap.php';

use Bot\Core\Cli\Kernel;

$kernel = new Kernel();
//-----------------------------------------------------------------
$kernel->call('make:model', function () {
    $database = new DatabaseMaker();
    $database->createModel();
});
//-----------------------------------------------------------------
$kernel->call('make:resource', function () {
    $resource = new ResourceMaker();
    $resource->createResources();
});

$kernel->call('remove:resource', function () {
    $resource = new ResourceMaker();
    $resource->removeResources();
});
//-----------------------------------------------------------------
$kernel->call('make:api', function () {
    $resource = new ApiMaker();
    $resource->createApi();
});

$kernel->call('remove:api', function () {
    $resource = new ApiMaker();
    $resource->removeApi();
});
//-----------------------------------------------------------------
$kernel->call('serve', function () {
    $server = new ServerMaker();
    $server->serve();
});

$kernel->call('start:apiserver', function () {
    $server = new ServerMaker();
    $server->runApiServer();
});

$kernel->call('start:openswoole', function () {
    $server = new ServerMaker();
    $server->runOpenswoole();
});

$kernel->call('setWebhook', function () {
    $server = new ServerMaker();
    $server->setWebhook();
});

$kernel->call('deleteWebhook', function () {
    $server = new ServerMaker();
    $server->deleteWebhook();
});
//-----------------------------------------------------------------
$kernel->call('get:eloquent', function () {
    $installer = new Installer();
    $installer->install_Eloquent();
});

$kernel->call('remove:eloquent', function () {
    $installer = new Installer();
    $installer->uninstall_Eloquent();
});

$kernel->call('get:amphp', function () {
    $installer = new Installer();
    $installer->install_Amphp();
});

$kernel->call('remove:amphp', function () {
    $installer = new Installer();
    $installer->uninstall_Amphp();
});

$kernel->call('get:openswoole', function () {
    $installer = new Installer();
    $installer->install_Openswoole();
});

$kernel->call('remove:openswoole', function () {
    $installer = new Installer();
    $installer->uninstall_Openswoole();
});

$kernel->call('get:redis', function () {
    $installer = new Installer();
    $installer->install_Redis();
});

$kernel->call('remove:redis', function () {
    $installer = new Installer();
    $installer->uninstall_Redis();
});

$kernel->call('clear:vendor', function () {
    $installer = new Installer();
    $installer->clear_vendor();
});
//-----------------------------------------------------------------
$kernel->shutdown();