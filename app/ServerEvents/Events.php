<?php

return [
    'Start' => function ($server) use ($host, $port) {
        echo "Start Server: $host:$port\n";
    },

    // 'Request' => function ($request, $response) use ($router) {
    //     $router->resolve($request, $response);
    // },

    'Request' => fn ($request, $response) => $router->resolve($request, $response),

    'Task' => function () {
        
    }
];