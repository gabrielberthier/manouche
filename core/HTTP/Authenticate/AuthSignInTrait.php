<?php

namespace App\Core\HTTP\Authenticate;

use Manouche\HTTP\Validate\Exceptions\ValidationException;
use App\Core\HTTP\Authenticate\Exceptions\UserExistsException;

trait AuthSignInTrait
{
    /**
     * @throws ValidationException
     * @throws UserExistsException
     * @param array $values
     * @return bool
     */
    public function make(array $values): bool
    {
        $this->userMaker($values);
        $user = $this->user->findOneBy("email", $this->user->getEmail());
        $jwtRaw = $this->userToSessionArray($user);
        $jwt = $this->encode($jwtRaw);
        return setcookie("jazz_token", $jwt, time() + 31536000, '/', "", false, true);
    }

    /**
     * sets a user in memory inside this object
     * @throws UserExistsException
     * @param array $request
     * @return void
     */
    private function userMaker(array $request)
    {
        $this
            ->user
            ->setUsername($request['username'])
            ->setEmail($request['email']);
        if ($this->user->exists()) {
            throw new UserExistsException("Este usuário ou email já existe");
        }
        $createdAt = new \DateTime('now', new \DateTimeZone('America/Sao_Paulo'));
        $updatedAt = new \DateTime('now', new \DateTimeZone('America/Sao_Paulo'));
        $this
            ->user
            ->setPassword($request['password'])
            ->setCreatedAt($createdAt)
            ->setUpdatedAt($updatedAt);
        $this->user->save();
    }
}
