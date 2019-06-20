<?php

namespace App\Core\HTTP;

trait ControllerMakerTrait
{
    public function transformsController($handler)
    {
        list($controller, $action) = explode('@', $handler);
        return 'Manouche\\HTTP\\Controllers\\' . $controller . "::" . $action;
    }
}
