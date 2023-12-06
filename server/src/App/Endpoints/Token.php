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
    private const NO_CREDENTIALS_MESSAGE = "Username or password not provided";
    private const INVALID_CREDENTIALS_MESSAGE = "Invalid username or password";

    protected function handleGetRequest(\App\Request $request): ResponseData
    {
        $user = $request->getAuthUser();
        $password = $request->getAuthPassword();
        if ($user === null || $password === null) {
            throw new \App\ClientException(\App\ResponseCode::UNAUTHORIZED, self::NO_CREDENTIALS_MESSAGE);
        }
        if (empty(trim($user)) || empty(trim($password))) {
            throw new \App\ClientException(\App\ResponseCode::UNAUTHORIZED, self::NO_CREDENTIALS_MESSAGE);
        }

        $userObj = $this->getDatabase()->getUserByEmail($user);
        if ($userObj === null) {
            throw new \App\ClientException(\App\ResponseCode::UNAUTHORIZED, self::INVALID_CREDENTIALS_MESSAGE);
        }

        if (!password_verify($password, $userObj["password"])) {
            throw new \App\ClientException(\App\ResponseCode::UNAUTHORIZED, self::INVALID_CREDENTIALS_MESSAGE);
        }

        $payload = [
            "iat" => time(),
            "exp" => time() + \Settings::TOKEN_VALID_DURATION,
            "iss" => $_SERVER["HTTP_HOST"],
            "sub" => $userObj["id"],
            // TODO: Any other fields to include?
        ];

        $token = [
            "token" => JWT::encode($payload, \Settings::SECRET, 'HS256'),
        ];

        return new ResponseData($token, \App\ResponseCode::OK);
    }
}
