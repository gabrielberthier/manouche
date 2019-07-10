<?php

namespace App\Core\HTTP\Authenticate;


use Manouche\Models\UserModel;

class AuthCreatorManager
{
    use AuthSignInTrait, AuthLoginTrait, JWTDealerTrait;
    /**
     * @Inject
     * @var UserModel
     */
    private $user;

}
