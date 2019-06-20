<?php

namespace Manouche\HTTP;

use App\Core\HTTP\Routes;
use League\Route\RouteGroup;

trait CustomRoutes
{
    public function loadRoutes()
    {

        Routes::get('/', "PagesController@home");

        Routes::get('about/{company}', "PagesController@about");

        Routes::group('/users',function (RouteGroup $rou) {
                $rou->get('/', 'UsersController@index');
            }
        );
    }
}
