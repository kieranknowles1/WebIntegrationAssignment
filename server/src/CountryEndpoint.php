<?php

/**
 * Endpoint to get all countries in the `affiliations` table
 * Results are ordered alphabetically and each country is returned exactly once
 *
 * @author Kieran Knowles
 * @generated GitHub Copilot was used to assist in writing this code
 */
class CountryEndpoint extends ChiEndpoint
{
    protected function handleGetRequest(): ResponseData
    {
        return new ResponseData($this->getDatabase()->getCountries(), ResponseCode::OK);
    }
}
