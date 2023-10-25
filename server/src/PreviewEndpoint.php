<?php

/**
 * Endpoint to get previews of random content from the CHI database
 * Results are ordered randomly and content without a preview video is excluded
 *
 * @author Kieran Knowles
 * @generated GitHub Copilot was used to assist in writing this code
 */
class PreviewEndpoint extends ChiEndpoint
{
    private int $limit = PHP_INT_MAX;

    protected function parseQueryParameter(string $key, string $value, array $allGet, array $allBody): void
    {
        if ($key === 'limit') {
            // TODO: Should validation be done in a separate function?
            if (!filter_var($value, FILTER_VALIDATE_INT)) {
                throw new ClientException(ResponseCode::BAD_REQUEST);
            }
            $this->limit = intval($value);
            if ($this->limit < 1) {
                throw new ClientException(ResponseCode::BAD_REQUEST);
            }
        } else {
            parent::parseQueryParameter($key, $value, $allGet, $allBody);
        }
    }

    protected function handleGetRequest(): ResponseData
    {
        return new ResponseData($this->getDatabase()->getRandomPreviews($this->limit), ResponseCode::OK);
    }
}
