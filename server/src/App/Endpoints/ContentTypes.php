<?php

namespace App\Endpoints;

/**
 * Endpoint to get all types declared in the `type` table
 * Results are ordered alphabetically. Types may not be used by any content
 *
 * @author Kieran Knowles
 * @generated GitHub Copilot was used to assist in writing this code
 */
class ContentTypes extends ChiEndpoint
{
    protected function handleGetRequest(\App\Request $request): ResponseData
    {
        return new ResponseData($this->getDatabase()->getContentTypes(), \App\ResponseCode::OK);
    }

    protected function getSupportedMethods(): array
    {
        return ['GET'];
    }
}
