<?php

namespace App\Core\HTTP\Authenticate;

use App\Core\HTTP\JWTrait\JWTraitMaker;

class Auth{
    use JWTraitMaker;

    public function createAuth(array $values){
        if(validated($values))
            $user = $user->find($vales['id'])
            if($user->pswd = $values['pswd'])
                $jwt  = $this->encode($values)
                send->Cookie($jwt, HTTPOnly)
        else
            $errors = $validation->errors();
            echo "<pre>";
            print_r($errors->firstOfAll());
            echo "</pre>";
            exit;
    }
}