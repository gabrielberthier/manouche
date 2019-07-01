<?php

namespace Manouche\HTTP\Controllers;

use Psr\Http\Message\ServerRequestInterface;
use App\Core\HTTP\ControllersDependencies\BaseController;
use App\Core\Utilities\Session;
use HansOtt\PSR7Cookies\SetCookie;

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

    public function printSession(ServerRequestInterface $request, $args)
    {   
        Session::write("key", 14);
        Session::dump();
        dd("");
    }

    public function search(ServerRequestInterface $request, $args)
    {   
        $search = $request->getQueryParams();
        return $this->render('search', compact('search'));
    }


    public function createCookie(ServerRequestInterface $request, $args)
    {   

        $search = $request->getCookieParams();
        $cookie = SetCookie::thatStaysForever('milla', 'kunis');
        $this->setResponse($cookie->addToResponse($this->getResponse()));
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
