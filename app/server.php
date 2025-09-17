<?php

include __DIR__ . "/vendor/autoload.php";

$host = getenv('SERVER') ? getenv('SERVER') : "0.0.0.0";
$port = getenv('PORT') ? getenv('PORT') : 9501;

$server = new OpenSwoole\HTTP\Server($host, $port);

$settings = require __DIR__ . "/ServerEvents/Settings.php";

$router = require __DIR__ . "/routes.php";

$serverEvents = require __DIR__ . "/ServerEvents/Events.php";

$server->set($settings);

foreach ($serverEvents as $event => $callback) {
    $server->on($event, $callback);
}

$server->start();