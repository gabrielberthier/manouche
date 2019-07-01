<?php

namespace App\Core\HTTP\Validate;

interface ValidateInterface{

    /**
     * Define rules to user input and requests
     *
     * @return array
     */
    public function rules(): array;

    /**
     * Define messages to required fields
     *
     * @see https://github.com/rakit/validation
     * @return array|null
     */
    public function messages();

}