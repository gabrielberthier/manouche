<?php

namespace App\Core\HTTP\Authenticate;

use Firebase\JWT\JWT;

trait JWTDealerTrait
{
    /**
     * Encodes a session in JWT and returns it as string
     *
     * @param array $toEncode
     * @return string
     */
    private function encode(array $toEncode): string
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
