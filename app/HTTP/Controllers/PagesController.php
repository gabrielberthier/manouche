<?php

namespace Manouche\HTTP\Controllers;

use Psr\Http\Message\ServerRequestInterface;
use App\Core\HTTP\ControllersDependencies\BaseController;

class PagesController extends BaseController
{
    /**
     * Show the home page.
     */
    public function home()
    {
        return $this->render('index');
    }

    /**
     * Show the about page.
     * ServerRequestInterface $request, Response $response, $args
     */
    public function about(ServerRequestInterface $request, $args)
    {   
        return $this->render('test', $args);
    }

    /**
     * Show the contact page.
     */
    public function contact()
    {
        return view('contact');
    }
}
