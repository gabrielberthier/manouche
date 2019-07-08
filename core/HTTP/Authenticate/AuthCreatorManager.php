<?php

namespace App\Core\HTTP\Authenticate;


use Manouche\Models\UserModel;
use App\Core\HTTP\Validate\ManoucheValidator as Validator;
use Manouche\HTTP\Validate\SigninValidation;
use App\Core\HTTP\Authenticate\UserExistsException;
use Manouche\HTTP\Validate\Exceptions\ValidationException;
use Firebase\JWT\JWT;

class AuthCreatorManager
{
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

    /**
     * Encodes a session in JWT and returns it as string
     *
     * @param array $toEncode
     * @return string
     */
    public function encode(array $toEncode) : string
    {
        $iat = time();
        $nbf = $iat;
        $exp = $nbf + (86400 * 31);

        $token_payload = [
            'iss' => 'manouche',
            'sub' => '1',
            "iat" => $iat,
            "nbf" => $nbf,
            "exp" => $exp,
            "data" => [
                "userId" => $toEncode['id'],
                "userName" => $toEncode['name'],
                "role" => $toEncode['role'],
                "email" => $toEncode['email']
            ]
        ];
        // This is your client secret
        $key = env("token-secret");
        // This is your id token
        return JWT::encode($token_payload, $key);
    }


}
