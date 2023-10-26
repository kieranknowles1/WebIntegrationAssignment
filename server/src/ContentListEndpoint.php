<?php

// TODO: Test cases
/**
 * Endpoint to get a list of content from the CHI database
 * Results are ordered by title and can be filtered by type
 *
 * @author Kieran Knowles
 * @generated GitHub Copilot was used to assist in writing this code
 */
class ContentListEndpoint extends ChiEndpoint
{
    private ?int $page = null;
    private ?string $type = null;

    protected function parseQueryParameter(string $key, string $value): void
    {
        if ($key === 'page') {
            // TODO: Should validation be done in a separate function?
            if (!filter_var($value, FILTER_VALIDATE_INT)) {
                throw new ClientException(ResponseCode::BAD_REQUEST);
            }
            $this->page = intval($value);
            if ($this->page < 1) {
                throw new ClientException(ResponseCode::BAD_REQUEST);
            }
        } elseif ($key === 'type') {
            $this->type = $value;
            if (!$this->getDatabase()->typeExists($this->type)) {
                throw new ClientException(ResponseCode::BAD_REQUEST);
            }
        } else {
            parent::parseQueryParameter($key, $value);
        }
    }

    protected function handleGetRequest(): ResponseData
    {
        return new ResponseData($this->getDatabase()->getContent($this->page, $this->type), ResponseCode::OK);
    }
}
