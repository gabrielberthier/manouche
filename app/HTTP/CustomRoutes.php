<?php

namespace Manouche\HTTP;

use App\Core\HTTP\Routes;
use League\Route\RouteGroup;

trait CustomRoutes
{
    public function loadRoutes()
    {

        Routes::get('/', "PagesController@home");

        Routes::get('/search', "PagesController@search");

        Routes::get('/createCookie', "PagesController@createCookie");

        Routes::get('about/{company}', "PagesController@about");

        Routes::group('/users',function (RouteGroup $rou) {
                $rou->get('/', 'UsersController@index');
                $rou->get('/hello/{name}', 'UsersController@hello');
                $rou->post('/save', 'UsersController@store');
            }
        );

        Routes::get('login', "LoginController@page");

        Routes::get('session', "PagesController@printSession");

        Routes::post("login/new", "LoginController@store");
    }
}
