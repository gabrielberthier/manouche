<?php

namespace Manouche\HTTP\Controllers\Auth;

use App\Core\HTTP\ControllersDependencies\BaseController;
use Psr\Http\Message\ServerRequestInterface;
use App\Core\HTTP\Validate\ManoucheValidator as Validator;
use Manouche\HTTP\Validate\SigninValidation;
use Manouche\Models\UserModel;
use Exception;
use App\Core\HTTP\Authenticate\Auth;

class SignInController extends BaseController
{
    /**
     * @Inject
     * @var UserModel
     */
    private $user;

    public function signInPage(ServerRequestInterface $request, $args)
    {
        return $this->render('signin/signin');
    }

    public function store(ServerRequestInterface $request, $args)
    {
        $values = $request->getParsedBody();
        $validator = new Validator();
        if ($validator->validate(
            $values,
            (new SigninValidation)
        )) {
            $user = $this->user;
            $user->setUsername($values['username']);
            $user->setEmail($values['email']);
            if ($user->exists()) {
                throw new Exception("Este usuário já existe"); die;
            }
            $user->setPassword($values['password']);
            $createdAt = new \DateTime('now', new \DateTimeZone('America/Sao_Paulo'));
            $updatedAt = new \DateTime('now', new \DateTimeZone('America/Sao_Paulo'));
            $user->setCreatedAt($createdAt);
            $user->setUpdatedAt($updatedAt);
            (new Auth)->createAuth([
                'name' => $user->getUsername(),
                'id' => 1,
                'role' => 'common'
            ]);
        } else {
            return $this->render(
                'signin/errors',
                ['errors' => $validator->getErrors()->toArray()]
            );
        }
    }
}
