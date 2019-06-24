<?php

namespace Manouche\HTTP\Controllers;

use Psr\Http\Message\ServerRequestInterface;
use App\Core\HTTP\ControllersDependencies\BaseController;

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

    public function search(ServerRequestInterface $request, $args)
    {   
        $search = $request->getQueryParams();
        return $this->render('search', compact('search'));
    }


    /**
     * Show the contact page.
     */
    public function contact()
    {
        return view('contact');
    }
}
