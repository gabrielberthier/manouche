<?php

namespace App\Core\HTTP;

use League\Route\Router;
use League\Route\Route;
use League\Route\RouteGroup;

class Routes
{


    private static $router;

    public static function store(Router $router): Router
    {
        self::$router = $router;
        return self::$router;
    }

    public static function map(string $method, string $path, $handler): Route
    {
        if (is_string($handler)) {
            list($controller, $action) = explode('@', $handler);
            $handler = 'Manouche\\HTTP\\Controllers\\' . $controller . "::" . $action;
        }
        return (self::$router)->map($method, $path, $handler);
    }

    public static function get(string $path, $handler): Route
    {
        return self::map("GET", $path, $handler);
    }

    public static function post(string $path, $handler): Route
    {
        return self::map("POST", $path, $handler);
    }

    public static function group(string $prefix, callable $handler) : RouteGroup
    {
        return self::$router->group($prefix, $handler);
    }
}
