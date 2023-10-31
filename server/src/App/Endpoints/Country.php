<?php

namespace App\Endpoints;

/**
 * Endpoint to get all countries in the `affiliations` table
 * Results are ordered alphabetically and each country is returned exactly once
 *
 * @author Kieran Knowles
 * @generated GitHub Copilot was used to assist in writing this code
 */
class Country extends ChiEndpoint
{
    protected function handleGetRequest(): ResponseData
    {
        return new ResponseData($this->getDatabase()->getCountries(), \App\ResponseCode::OK);
    }
}
