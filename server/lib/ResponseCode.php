<?php

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

    case BAD_REQUEST = 400;
    case NOT_FOUND = 404;
    case METHOD_NOT_ALLOWED = 405;

    public static function getMessage(ResponseCode $code): string
    {
        return match ($code) {
            ResponseCode::OK => "OK",

            ResponseCode::BAD_REQUEST => "Bad Request",
            ResponseCode::NOT_FOUND => "Not Found",
            ResponseCode::METHOD_NOT_ALLOWED => "Method Not Allowed",
        };
    }
}
