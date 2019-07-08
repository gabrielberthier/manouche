<?php

namespace Manouche\HTTP\Controllers\Auth;

use Psr\Http\Message\ServerRequestInterface;
use App\Core\HTTP\ControllersDependencies\BaseController;
use Zend\Diactoros\Response\RedirectResponse;
use HansOtt\PSR7Cookies\SetCookie;

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

    public function logout(ServerRequestInterface $request, $args){
        $cookie = SetCookie::thatDeletesCookie('jazz_token');
        $redirectResponse = new RedirectResponse("/", 301);
        $response = $cookie->addToResponse($redirectResponse);
        return $response;
    }

}
