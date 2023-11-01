<?php

namespace App\Endpoints;

// TODO: Update API docs

/**
 * Endpoint to get previews of random content from the CHI database
 * Results are ordered randomly and content without a preview video is excluded
 *
 * @author Kieran Knowles
 * @generated GitHub Copilot was used to assist in writing this code
 */
class AuthorAffiliation extends ChiEndpoint
{
    private ?int $contentId = null;
    private ?string $countryName = null;

    protected function parseQueryParameter(string $key, string $value): void
    {
        if ($key === 'content') {
            if ($this->countryName !== null) {
                throw new \App\ClientException(\App\ResponseCode::BAD_REQUEST, "Cannot filter by both content_id and country_name");
            }
            $this->contentId = \App\ArgumentParser::parseInt($key, $value, 1, PHP_INT_MAX);
        } elseif ($key === 'country') {
            if ($this->contentId !== null) {
                throw new \App\ClientException(\App\ResponseCode::BAD_REQUEST, "Cannot filter by both content_id and country_name");
            }
            $this->countryName = $value;
            if (!$this->getDatabase()->countryExists($this->countryName)) {
                throw new \App\ClientException(\App\ResponseCode::BAD_REQUEST, "Country '$value' does not exist in the database");
            }
        } else {
            parent::parseQueryParameter($key, $value);
        }
    }

    protected function handleGetRequest(): ResponseData
    {
        $data = null;
        if ($this->contentId !== null) {
            $data = $this->getDatabase()->getAffiliationsByContent($this->contentId);
        } elseif ($this->countryName !== null) {
            $data = $this->getDatabase()->getAffiliationsByCountry($this->countryName);
        } else {
            $data = $this->getDatabase()->getAffiliations();
        }

        return new ResponseData($data, \App\ResponseCode::OK);
    }
}
