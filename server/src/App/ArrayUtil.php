<?php

namespace App;

use Firebase\JWT\JWT;

/**
 * Helper class for working with arrays
 *
 * @author Kieran Knowles
 * @generated GitHub Copilot was used to assist in writing this code
 */
abstract class ArrayUtil
{
    private function __construct() {}

    /**
     * Case insensitive array search
     * @param string[] $array The array to search
     * @param string $value The value to search for
     */
    public static function ciContains(array $array, string $value): bool
    {
        foreach ($array as $item) {
            if (strcasecmp($item, $value) === 0) {
                return true;
            }
        }
        return false;
    }
}
