<?php

namespace App\Core\HTTP\JWTrait;

use Firebase\JWT\JWT;
use \UnexpectedValueException;
use Firebase\JWT\SignatureInvalidException;
use Firebase\JWT\BeforeValidException;
use Firebase\JWT\ExpiredException;

trait JWTraitMaker
{
    /**
     * Decodes a JWT string into a PHP object and 
     * makes self::payload have a new returned value
     *
     * @param string        $jwt            The JWT
     * @param string|array  $key            The key, or map of keys.
     *                                      If the algorithm used is asymmetric, this is the public key
     * @param array         $allowed_algs   List of supported verification algorithms
     *                                      Supported algorithms are 'HS256', 'HS384', 'HS512' and 'RS256'
     *
     * @return object The JWT's payload as a PHP object
     *
     * @throws UnexpectedValueException     Provided JWT was invalid
     * @throws SignatureInvalidException    Provided JWT was invalid because the signature verification failed
     * @throws BeforeValidException         Provided JWT is trying to be used before it's eligible as defined by 'nbf'
     * @throws BeforeValidException         Provided JWT is trying to be used before it's been created as defined by 'iat'
     * @throws ExpiredException             Provided JWT has since expired, as defined by the 'exp' claim
     *
     * @uses jsonDecode
     * @uses urlsafeB64Decode
     */
    public static function decode(string $jwt){
        self::$payload = JWT::decode($jwt, env("token-secret"), array('HS256'));
    }

    

    public static function jwtDestroy()
    {
        $key = "jazz_token";
        unset($_COOKIE[$key]);
        setcookie($key, '', time() - 3600, '/'); // empty value and old timestamp
    }
}
