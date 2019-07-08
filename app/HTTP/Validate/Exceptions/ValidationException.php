<?php

namespace Manouche\HTTP\Validate\Exceptions;

use Exception;

class ValidationException extends Exception
{
    private $errors;

    public function __construct($message, array $errors) {
        $this->errors = $errors;
        parent::__construct($message);
    }

    // personaliza a apresentação do objeto como string
    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }

    public function getErrors(){
        return $this->errors;
    }

    public function redirect() {
        redirect("/");
    }
}