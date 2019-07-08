<?php

namespace App\Core\HTTP\Authenticate;

use App\Core\HTTP\JWTrait\JWTraitMaker;
use Manouche\Models\UserModel;
use App\Core\HTTP\Validate\ManoucheValidator as Validator;
use Manouche\HTTP\Validate\SigninValidation;
use App\Core\HTTP\Authenticate\UserExistsException;
use Manouche\HTTP\Validate\Exceptions\ValidationException;

class Auth
{

    use JWTraitMaker;

    /**
     * @Inject
     * @var UserModel
     */
    private $user;

    /**
     * @throws ValidationException
     * @throws UserExistsException
     * @param array $values
     * @return bool
     */
    public function make(array $values) : bool
    {
        $validator = new Validator();
        if ($validator->validate($values, (new SigninValidation))) {
            $this->userMaker($values);
            $user = $this->user->findOneBy("email", $this->user->getEmail());
            $jwtRaw = [
                'name' => $user->getUsername(),
                'id' => $user->getIdusers(),
                'role' => $user->getRoles(),
                'email' => $user->getEmail()
            ];

            $jwt = $this->encode($jwtRaw);
            return setcookie("jazz_token", $jwt, time() + 31536000, '/', "", false, true);
        } else {
            throw new ValidationException(
                "Os campos requeridos não foram preenchidos corretamente",
                ['errors' => $validator->getErrors()->toArray()]
            );
        }
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
