<?php

namespace Manouche\HTTP\Validate;

use App\Core\HTTP\Validate\ValidateInterface;

class LoginValidation implements ValidateInterface
{

    /**
     * @inheritDoc
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'user'                  => 'required|min:4',
            'password'              => 'required|min:6',
        ];
    }
    /**
     * @inheritDoc
     *
     * @return array|null
     */
    public function messages(){
        return [
            'user:min' => 'O tamanho de usuário não é permitido',
            'password:min' => 'Senha muito pequena, hmmm '
        ];
    }
}
