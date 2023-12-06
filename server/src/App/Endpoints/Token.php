<?php

namespace App\Endpoints;

use Firebase\JWT\JWT;

/**
 * Endpoint to authenticate a user, returning a JWT token
 *
 * @author Kieran Knowles
 * @generated GitHub Copilot was used to assist in writing this code
 */
class Token extends UserEndpoint
{
    protected function handleGetRequest(\App\Request $request): ResponseData
    {
        // TODO: Check authorization header is present and formatted correctly
        // TODO: Check password is correct. Return 401 if not

        $user = $request->getAuthUser();
        $password = $request->getAuthPassword();
        if ($user === null || $password === null) {
            throw new \App\ClientException(\App\ResponseCode::UNAUTHORIZED, "Username or password not provided");
        }

        echo "User: $user\n";
        echo "Password: $password\n";

        $payload = [
            "iat" => time(),
            "exp" => time() + \Settings::TOKEN_VALID_DURATION,
            "iss" => $_SERVER["HTTP_HOST"],
            "sub" => "user", // TODO: Put user ID here
            // TODO: Any other fields to include?
        ];

        $token = [
            "token" => JWT::encode($payload, \Settings::SECRET, 'HS256'),
        ];

        return new ResponseData($token, \App\ResponseCode::OK);
    }
}
