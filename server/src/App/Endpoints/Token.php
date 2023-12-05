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
        $headers = $request->getHeaders();

        // TODO: Check authorization header is present and formatted correctly
        // TODO: Check password is correct. Return 401 if not

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
