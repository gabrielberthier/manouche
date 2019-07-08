<?php

namespace Manouche\HTTP\Controllers\Auth;

use App\Core\HTTP\ControllersDependencies\BaseController;
use Psr\Http\Message\ServerRequestInterface;
use App\Core\HTTP\Authenticate\UserExistsException;
use Manouche\HTTP\Validate\Exceptions\ValidationException;
use Zend\Diactoros\Response\RedirectResponse;
use App\Core\HTTP\Authenticate\AuthCreatorManager;

class SignInController extends BaseController
{
    /**
     * @Inject
     * @var AuthCreatorManager
     */
    private $auth;

    public function signInPage(ServerRequestInterface $request, $args)
    {
        return $this->render('signin/signin');
    }

    public function error(ServerRequestInterface $request, $args)
    {
        return $this->render('signin/signin');
    }

    public function store(ServerRequestInterface $request, $args)
    {
        $values = $request->getParsedBody();
        try 
        {
            if($this->auth->make($values)){
                return new RedirectResponse("/users/hello", 301);
            }
            else {
                $this->getResponse()->getBody()->write(
                    "<h1>Cookie impossível de ser criado</h1>"
                );
                return $this->getResponse();
            }
        } 
        catch (UserExistsException $userExistsException) 
        {
            return $this->render(
                'signin/errors',
                ['errors' => ["Usuário já existente " => $userExistsException->getMessage()]]
            );
        } 
        catch (ValidationException $vldEx) 
        {
            return $this->render(
                'signin/errors',
                $vldEx->getErrors()
            );
        }
    }
}
