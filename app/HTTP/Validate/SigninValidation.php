<?php

namespace Manouche\HTTP\Validate;

use App\Core\HTTP\Validate\ValidateInterface;

class SigninValidation implements ValidateInterface
{

    /**
     * @inheritDoc
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'username'              => 'required|min:4',
            'email'                 => 'required|email',
            'password'              => 'required|min:6',
        ];
    }
    /**
     * @inheritDoc
     *
     * @return array|null
     */
    public function messages(){
        return null;
    }
}
