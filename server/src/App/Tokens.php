<?php

namespace App;

use Firebase\JWT\JWT;

abstract class Tokens
{
    private function __construct() {}

    public static function issueToken(int $userId): string
    {
        $payload = [
            "iat" => time(),
            "nbf" => time(),
            "exp" => time() + \Settings::TOKEN_VALID_DURATION,
            "iss" => $_SERVER["HTTP_HOST"],
            "sub" => $userId,
            // TODO: Any other fields to include?
        ];

        return JWT::encode($payload, \Settings::SECRET, 'HS256');
    }

    /**
     * Check that the token in the request is valid and has not expired
     * @throws ClientException if the token is invalid. Message will provide details
     * @return int The user ID the token was issued to
     */
    public static function getTokenUserId(Request $request): int {
        $token = $request->getHeaders()["Authorization"] ?? null;

        if ($token === null) {
            throw new ClientException(ResponseCode::UNAUTHORIZED, "No token provided");
        }

        if (!preg_match("/^Bearer (.+)$/", $token, $matches)) {
            throw new ClientException(ResponseCode::UNAUTHORIZED, "Expected bearer token");
        }

        $value = $matches[1];

        $decoded = null;
        try {
            $decoded = JWT::decode($value, new \Firebase\JWT\Key(\Settings::SECRET, 'HS256'));
        } catch (\Firebase\JWT\BeforeValidException $e) {
            throw new ClientException(ResponseCode::UNAUTHORIZED, "Token not yet valid");
        } catch (\Firebase\JWT\ExpiredException $e) {
            throw new ClientException(ResponseCode::UNAUTHORIZED, "Token expired");
        } catch (\UnexpectedValueException $e) {
            throw new ClientException(ResponseCode::UNAUTHORIZED, "Invalid token");
        }

        return $decoded->sub;
    }
}
