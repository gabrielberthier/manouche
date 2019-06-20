<?php

namespace App\Core\HTTP;

use Manouche\HTTP\CustomRoutes;
use League\Route\Router;

class RouterFacade{

    use CustomRoutes;

    public function fill(Router $route){
        Routes::store($route);
        $this->loadRoutes();
    }

}