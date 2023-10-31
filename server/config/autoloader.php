<?php

// TODO: MOve to settings file
const SRC_DIR = '/var/www/html/src/';

/**
 * Autoload classes in the lib directory
 * Based on @see https://www.php.net/manual/en/language.oop5.autoload.php
 *
 * @generated GitHub Copilot was used to assist in writing this code
 * @author Kieran Knowles
 */
spl_autoload_register(function (string $class): void {
    include SRC_DIR . str_replace('\\', '/', $class) . '.php';
});
