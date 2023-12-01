<?php

namespace App\Endpoints;

/**
 * Base class for endpoints using the user database
 *
 * @author Kieran Knowles
 * @generated GitHub Copilot was used to assist in writing this code
 */
abstract class UserEndpoint extends Endpoint
{
    private \App\UserDatabase $database;

    public function __construct(\App\UserDatabase $database)
    {
        $this->database = $database;
    }

    protected function getDatabase(): \App\UserDatabase
    {
        return $this->database;
    }
}
