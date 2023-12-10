<?php

namespace App\Endpoints;

/**
 * Endpoint to get a list of content from the CHI database
 * Results are ordered by title and can be filtered by type
 *
 * @author Kieran Knowles
 * @generated GitHub Copilot was used to assist in writing this code
 */
class ContentList extends ChiEndpoint
{
    private ?int $page = null;
    private ?string $type = null;

    protected function parseQueryParameter(string $key, string $value): void
    {
        if ($key === 'page') {
            $this->page = \App\ArgumentParser::parseInt($key, $value, 1, PHP_INT_MAX);
        } elseif ($key === 'type') {
            $this->type = $value;
            $validTypes = $this->getDatabase()->getContentTypes();
            if (!\App\ArrayUtil::ciContains($validTypes, $value)) {
                throw new \App\ClientException(\App\ResponseCode::BAD_REQUEST, "Type '$value' does not exist");
            }
        } else {
            parent::parseQueryParameter($key, $value);
        }
    }

    protected function handleGetRequest(\App\Request $request): ResponseData
    {
        return new ResponseData($this->getDatabase()->getContent($this->page, $this->type), \App\ResponseCode::OK);
    }
}
