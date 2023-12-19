<?php

namespace App;

/**
 * HTTP response codes
 * Based on https://developer.mozilla.org/en-US/docs/Web/HTTP/Status
 *
 * @author Kieran Knowles
 * @generated GitHub Copilot was used to assist in writing this code
 */
enum ResponseCode: int
{
    case OK = 200;
    case NO_CONTENT = 204;

    case BAD_REQUEST = 400;
    case UNAUTHORIZED = 401;
    case NOT_FOUND = 404;
    case METHOD_NOT_ALLOWED = 405;

    case INTERNAL_SERVER_ERROR = 500;

    public static function getMessage(ResponseCode $code): string
    {
        // NOTE: PHPStan checks that this is exhaustive, so no need for a default case
        return match ($code) {
            ResponseCode::OK => "OK",
            ResponseCode::NO_CONTENT => "No Content",

            ResponseCode::BAD_REQUEST => "Bad Request",
            ResponseCode::UNAUTHORIZED => "Unauthorized",
            ResponseCode::NOT_FOUND => "Not Found",
            ResponseCode::METHOD_NOT_ALLOWED => "Method Not Allowed",

            ResponseCode::INTERNAL_SERVER_ERROR => "Internal Server Error",
        };
    }
}
