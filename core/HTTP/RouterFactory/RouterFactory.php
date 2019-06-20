<?php

namespace App\Core\HTTP\RouterFactory;

use League\Route\Router;
use DI\Container;
use League\Route\Strategy\ApplicationStrategy;
use App\Core\HTTP\RouterFacade;

class RouterFactory
{

    public static function make(Container $container): Router
    {
        $strategy = new ApplicationStrategy;
        $strategy->setContainer($container);
        $router   = (new Router())->setStrategy($strategy);
        (new RouterFacade)->fill($router);
        return $router;
    }
}
