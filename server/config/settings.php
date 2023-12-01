<?php

/**
 * Global settings used by the server
 *
 * @author Kieran Knowles
 * @generated GitHub Copilot was used to assist in writing this code
 */
class Settings
{
    private function __construct() {}

    public const SERVER_ROOT = '/var/www/html/';
    public const SRC_DIR = self::SERVER_ROOT . 'src/';
    public const VENDOR_DIR = self::SERVER_ROOT . 'vendor/';

    public const CHI_DATABASE_FILE = self::SERVER_ROOT . 'data/chi2023.sqlite';

    public const API_ROOT = '/api/';

    public const TOKEN_VALID_DURATION = 60 * 30; // 30 minutes

    // NOTE: This normally wouldn't be stored in the source code, but for the
    // purposes of this project it is fine
    public const SECRET = "F56D5C8E61A875D6FD28B36FE24E3";
}
