<?php

namespace App\Core\HTTP\Authenticate;

use App\Core\HTTP\JWTrait\JWTraitMaker;

class Auth
{

    use JWTraitMaker;
    /**
     * Who owns the token
     *
     * @var object|null
     */
    private static $payload = null;

    /**
     * returns true if jwt exists and
     * is corret
     *
     * @return void
     */
    public static function authExists(){
        return isset($_COOKIE['jazz_token']);
    }    

    public static function getPayload(){
        return self::$payload;
    }

    public static function getData(){
        return self::$payload->data;
    }

}
