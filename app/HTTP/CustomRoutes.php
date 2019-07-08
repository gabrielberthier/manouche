<?php

namespace Manouche\HTTP;

use App\Core\HTTP\Routes;
use League\Route\RouteGroup;
use Manouche\HTTP\Middlewares\AuthenticateMiddleware;

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
                $rou->get('/hello', 'UsersController@hello');
                $rou->post('/save', 'UsersController@store');
            }
        );
        Routes::get('session', "PagesController@printSession");
        //Login stuff
        Routes::get('login', "Auth\LoginController@page");
        Routes::post("login/validate", "Auth\LoginController@store");
        Routes::get("/logout", "Auth\\LoginController@logout");
        //SignIn stuff
        Routes::get('signin', "Auth\SignInController@signInPage");
        Routes::post('signin/store', "Auth\SignInController@store");
        
    }
}
