<?php

namespace Manouche\HTTP\Controllers\Auth;

use Psr\Http\Message\ServerRequestInterface;
use App\Core\HTTP\ControllersDependencies\BaseController;
use Zend\Diactoros\Response\RedirectResponse;
use Manouche\HTTP\Validate\LoginValidation;
use Manouche\HTTP\Validate\Exceptions\ValidationException;
use App\Core\HTTP\Authenticate\Exceptions\UserDoesNotExistException;
use App\Core\HTTP\Authenticate\Auth;

class LoginController extends BaseController
{
    /**
     * @Inject
     * @var Auth
     */
    private $authie;
    
    public function page(ServerRequestInterface $request, $args = [])
    {
        return $this->render('login/page');
    }

    /**
     * Show the about page.
     * ServerRequestInterface $request, Response $response, $args
     */
    public function about(ServerRequestInterface $request, $args)
    {
        return $this->render('test', $args);
    }

    public function login($request, array $args = [])
    {
        $params = $request->getParsedBody();
        try {
            if
            ($this->verify($params, (new LoginValidation))
                ->authie->makesLogin($params))
            {
                return new RedirectResponse("/users/hello", 301);
            }
            else 
            {
                $this->getResponse()->getBody()->write(
                    "<h1>Cookie impossível de ser criado</h1>"
                );
                return $this->getResponse();
            }
        } 
        catch (ValidationException $vldEx) 
        {
            return $this->render(
                'signin/errors',
                $vldEx->getErrors()
            );
        }
        catch(UserDoesNotExistException $exception)
        {
            return $this->render(
                'signin/errors',
                ['errors' => ["Iiih, aparentemente tivemos um erro" => [$exception->getMessage()]]]
            );
        }
    }

    public function logout(ServerRequestInterface $request, $args)
    {
        Auth::jwtDestroy();
        // $redirectResponse = new RedirectResponse("/", 302);
        // $response = $cookie->addToResponse($redirectResponse);
        // return $response;
        return new RedirectResponse("/", 302);
    }
}
