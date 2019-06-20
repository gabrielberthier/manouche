<?php

namespace App\Core\HTTP;

use League\Route\RouteGroup;
use League\Route\RouteCollectionInterface;
use League\Route\Route;

class RouterGroupCustom extends RouteGroup{

    use ControllerMakerTrait;

    public function __construct(string $prefix, callable $callback, RouteCollectionInterface $collection)
    {
        parent::__construct($prefix, $callback, $collection);
    }

    //$route->map('GET', '/acme/route1', 'AcmeController::actionOne');
    /**
     * Undocumented function
     *
     * @param string $method
     * @param string $path
     * @param callable|string $handler
     * @return Route
     */
    public function map(string $method, string $path, $handler) : Route
    {
        if(is_string($handler)){
            $handler = $this->transformsController($handler);
            dd($handler);
        }
        return parent::map($method, $path, $handler);
    }

    public function get(string $path, $handler): Route
    {
        return $this->map("GET", $path, $handler);
    }

    public function post(string $path, $handler): Route
    {
        return $this->map("POST", $path, $handler);
    }

}