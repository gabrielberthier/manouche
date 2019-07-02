<?php

namespace App\Core\HTTP\Validate;

use Rakit\Validation\Validator;
use Rakit\Validation\ErrorBag;

class ManoucheValidator
{
    /**
     * @var Validator
     */
    private $validator;

    public function __construct() {
        $this->validator = new Validator();
    }

    /**
     * Errors response
     *
     * @var ErrorBag
     */
    private $errors;

    public function validate(array $input, ValidateInterface $customValidation)
    {

        // make it
        $validation = $this->validator->make($input, $customValidation->rules());

        //if custom validation has messages defined
        if($customValidation->messages() !== null){
            $validation->setMessages($customValidation->messages());
        }

        // then validate
        $validation->validate();

        if ($res = $validation->fails()) {
            // handling errors
            $this->errors = $validation->errors();
        }

        return !$res;
    }
    /**
     * Get all errors
     *
     * @return ErrorBag
     */
    public function getErrors(){
        return $this->errors;
    }
}
