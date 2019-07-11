<?php

namespace App\Core\HTTP\Authenticate;

use App\Core\HTTP\Authenticate\Exceptions\UserDoesNotExistException;

trait AuthLoginTrait
{
    /**
     * Returns a user if they exist
     *
     * @param string $user
     * @return null|object
     */
    public function hasUser(string $user)
    {
        $basedBy = 'username';
        if (filter_var($user, FILTER_VALIDATE_EMAIL)) {
            $basedBy = "email";
        }
        return $this->user->findOneBy($basedBy, $user);
    }

    /**
     * Makes the login in the platform
     * @throws UserDoesNotExistException
     * @param array $param
     * @return boolean
     */
    public function makesLogin(array $params)
    {
        $user = $this->hasUser($params['user']);
        if (isset($user)) {
            if (manoucheCheck($params['password'], $user->getPassword()) === true) {
                $jwtRaw = $this->userToSessionArray($user);
                $jwt = $this->encode($jwtRaw);
                return setcookie("jazz_token", $jwt, time() + 31536000, '/', "", false, true);
            }
        }
        throw new UserDoesNotExistException("O usuário não existe ou a senha está errada");
    }
    /**
     * Valida a entrada
     * Verifica se o usuário já existe
     * Compara a senha 
     * Criar a sessão
     * Redireciona
     */
}
