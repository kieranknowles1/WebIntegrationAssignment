<?php

namespace App\Endpoints;

/**
 * Endpoint to get previews of random content from the CHI database
 * Results are ordered randomly and content without a preview video is excluded
 *
 * @author Kieran Knowles
 * @generated GitHub Copilot was used to assist in writing this code
 */
class Preview extends ChiEndpoint
{
    private int $limit = PHP_INT_MAX;

    protected function parseQueryParameter(string $method, string $key, string $value): void
    {
        if ($key === 'limit') {
            $this->limit = \App\ArgumentParser::parseInt($key, $value, 1, PHP_INT_MAX);
        } else {
            parent::parseQueryParameter($method, $key, $value);
        }
    }

    protected function handleGetRequest(\App\Request $request): ResponseData
    {
        return new ResponseData($this->getDatabase()->getRandomPreviews($this->limit), \App\ResponseCode::OK);
    }
}
