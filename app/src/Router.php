<?php

namespace Chat;

class Router
{
    protected array $routes = [];

    protected array $headers = [
        
    ];

    public function __construct() { }

    public function add(string $method, string $path, $callback)
    {
        $method = strtolower($method);
        $uri = substr($path, 0, 1) !== '/' ? '/' . $path : $path;
        $pattern = str_replace('/', '\/', $uri);
        $pattern = '/^' . $pattern . '$/';

        $this->routes[$method][$pattern] = $callback;
        return $this;
    }

    public function resolve($request, $response)
    {
        $method = strtolower($request->getMethod());
        $uri = $request->server['request_uri'];

        $content = 404;

        foreach ($this->routes[$method] ?? [] as $pattern => $callback) {
            if (preg_match($pattern, $uri, $parameters)) {
                array_shift($parameters);
                $content = call_user_func_array($callback, $parameters);
                break; 
            }
        }

        $response->end($content);
    }
}