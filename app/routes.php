<?php

$router = new \Chat\Router();

$router->add('get', '/', function () {
    return "# HomePage";
});

$router->add('get', '/tasks/{id}', function ($a = 1) {
    return "# Detalhes da task";
});

return $router;