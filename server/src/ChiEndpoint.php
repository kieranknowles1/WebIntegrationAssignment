<?php

/**
 * Base class for endpoints using the CHI database
 *
 * @author Kieran Knowles
 * @generated GitHub Copilot was used to assist in writing this code
 */
class ChiEndpoint extends Endpoint
{
    private ChiDatabase $database;

    // TODO: Is this, ChiDatabase, and DatabaseConnection good usage of DI?
    public function __construct(ChiDatabase $database)
    {
        $this->database = $database;
    }

    protected function handleGetRequest(): ResponseData
    {
        return new ResponseData($this->database->getCountries(), ResponseCode::OK);
    }

    protected function getDatabase(): ChiDatabase
    {
        return $this->database;
    }
}
