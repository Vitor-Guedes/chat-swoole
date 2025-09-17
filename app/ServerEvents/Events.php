<?php

return [
    'Start' => function ($server) use ($host, $port) {
        echo "Start Server: $host:$port\n";
    },

    'Request' => fn ($request, $response) => $router->resolve($request, $response),

    'Task' => function () {}
];