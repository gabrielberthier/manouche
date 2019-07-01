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
            'name'                  => 'required|min:6',
            'email'                 => 'required|email',
            'password'              => 'required|min:6',
            'confirm_password'      => 'required|same:password',
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
