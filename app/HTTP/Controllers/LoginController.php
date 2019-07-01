<?php

namespace Manouche\HTTP\Controllers;

use Psr\Http\Message\ServerRequestInterface;
use App\Core\HTTP\ControllersDependencies\BaseController;
use App\Core\Utilities\Session;

class LoginController extends BaseController
{
    /**
     * Show the login page.
     */
    public function page()
    {
        return $this->render('signin/login');
    }

    /**
     * Show the about page.
     * ServerRequestInterface $request, Response $response, $args
     */
    public function about(ServerRequestInterface $request, $args)
    {   
        return $this->render('test', $args);
    }


    public function store(ServerRequestInterface $request, $args)
    {   
        Session::w('pao', 'batata');
        Session::dump();
        dd($request->getParsedBody());
        return $this->render('search', compact('search'));
    }
}
