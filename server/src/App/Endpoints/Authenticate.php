<?php

namespace App\Endpoints;

/**
 * Endpoint to authenticate a user, returning a JWT token
 *
 * @author Kieran Knowles
 * @generated GitHub Copilot was used to assist in writing this code
 */
class Authenticate extends UserEndpoint
{
    protected function handleGetRequest(\App\Request $request): ResponseData
    {
        $headers = $request->getHeaders();

        var_dump($headers);
    }
}
