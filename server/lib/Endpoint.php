<?php

// TODO: Check parameters and throw if out of expected range. What is the best way to do this?
/**
 * Base class for all API endpoints
 *
 * @author Kieran Knowles
 * @generated GitHub Copilot was used to assist in writing this code
 */
abstract class Endpoint
{
    /**
     * Get the data returned by the endpoint
     */
    protected function handleGetRequest(): mixed
    {
        // TODO: BadMethodException extending ClientException
        throw new Exception("GET requests are not supported for this endpoint");
    }

    public function getData($method): mixed
    {
        switch ($method) {
            case "GET": return $this->handleGetRequest();
                // TODO: BadMethodException extending ClientException
            default: throw new Exception("Method not supported");
        }
    }
}
