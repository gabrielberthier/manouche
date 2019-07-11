<?php

namespace App\Core\HTTP\Authenticate;


use Manouche\Models\UserModel;

class Auth
{
    use AuthSignInTrait, AuthLoginTrait, JWTDealerTrait, AuthStaticElements;
    /**
     * @Inject
     * @var UserModel
     */
    private $user;

    public function getUser()
    {
        return $this->user->find(self::getData()->id);
    }

    private function userToSessionArray(UserModel $user){
        return [
            'name' => $user->getUsername(),
            'id' => $user->getIdusers(),
            'role' => $user->getRoles(),
            'email' => $user->getEmail()
        ];
    }

}
