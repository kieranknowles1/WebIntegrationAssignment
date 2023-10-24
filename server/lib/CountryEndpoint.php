<?php

/**
 * Endpoint to get all countries in the `affiliations` table
 * Results are ordered alphabetically and each country is returned exactly once
 *
 * @author Kieran Knowles
 * @generated GitHub Copilot was used to assist in writing this code
 */
class CountryEndpoint extends Endpoint
{
    private ChiDatabase $database;

    // TODO: Is this, ChiDatabase, and DatabaseConnection good usage of DI?
    public function __construct(ChiDatabase $database)
    {
        $this->database = $database;
    }

    protected function handleGetRequest(): mixed
    {
        return $this->database->getCountries();
    }
}
