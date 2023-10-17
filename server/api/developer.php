<?php

// TODO: Is there a better way to include these files?
// TODO: Using this shouldn't require the extension to be .php
// TODO: Document API in postman
require_once "../config/autoloader.php";
require_once "../config/exceptionhandler.php";

/**
 * Endpoint to get developer information
 *
 * @author Kieran Knowles
 * @generated GitHub Copilot was used to assist in writing this code
 */
class DeveloperEndpoint extends Endpoint
{
    protected function processRequest(): mixed
    {
        return [
            'name' => 'Kieran Knowles',
            'student_id' => 'w20013000',
        ];
    }
}

$endpoint = new DeveloperEndpoint();
$endpoint->run();
