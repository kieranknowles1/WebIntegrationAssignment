<?php

/**
 * Base class for endpoints using the CHI database
 *
 * @author Kieran Knowles
 * @generated GitHub Copilot was used to assist in writing this code
 */
abstract class ChiEndpoint extends Endpoint
{
    private ChiDatabase $database;

    public function __construct(ChiDatabase $database)
    {
        $this->database = $database;
    }

    protected function getDatabase(): ChiDatabase
    {
        return $this->database;
    }
}
