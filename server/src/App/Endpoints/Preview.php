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

    protected function parseQueryParameter(string $key, string $value): void
    {
        if ($key === 'limit') {
            // TODO: Should validation be done in a separate function?
            if (!filter_var($value, FILTER_VALIDATE_INT)) {
                throw new \App\ClientException(\App\ResponseCode::BAD_REQUEST);
            }
            $this->limit = intval($value);
            if ($this->limit < 1) {
                throw new \App\ClientException(\App\ResponseCode::BAD_REQUEST);
            }
        } else {
            parent::parseQueryParameter($key, $value);
        }
    }

    protected function handleGetRequest(): \App\ResponseData
    {
        return new \App\ResponseData($this->getDatabase()->getRandomPreviews($this->limit), \App\ResponseCode::OK);
    }
}
