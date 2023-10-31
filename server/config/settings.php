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

    public const CHI_DATABASE_FILE = self::SERVER_ROOT . 'data/chi2023.sqlite';
}
