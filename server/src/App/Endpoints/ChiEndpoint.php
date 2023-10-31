<?php

namespace App\Endpoints;

/**
 * Base class for endpoints using the CHI database
 *
 * @author Kieran Knowles
 * @generated GitHub Copilot was used to assist in writing this code
 */
abstract class ChiEndpoint extends Endpoint
{
    private \App\ChiDatabase $database;

    public function __construct(\App\ChiDatabase $database)
    {
        $this->database = $database;
    }

    protected function getDatabase(): \App\ChiDatabase
    {
        return $this->database;
    }
}
