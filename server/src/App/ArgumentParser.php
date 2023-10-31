<?php

namespace App;

/**
 * This class is responsible for parsing and validating the arguments passed to a request.
 *
 * @author Kieran Knowles
 * @generated GitHub Copilot was used to assist in writing this code
 */
class ArgumentParser
{
    private function __construct() {}

    /**
     * Parse a string as an integer and check that it is within the given range
     * @param string $raw the string to parse
     * @param int $min the minimum value of the integer, can be PHP_INT_MIN
     * @param int $max the maximum value of the integer, can be PHP_INT_MAX
     * @return int the parsed integer
     * @throws ClientException if the string is not a valid integer or is outside the given range
     */
    public static function parseInt(string $raw, int $min, int $max): int
    {
        if (!filter_var($raw, FILTER_VALIDATE_INT)) {
            throw new ClientException(ResponseCode::BAD_REQUEST);
        }
        $parsed = intval($raw);

        if ($parsed < $min || $parsed > $max) {
            throw new ClientException(ResponseCode::BAD_REQUEST);
        }

        return $parsed;
    }
}
