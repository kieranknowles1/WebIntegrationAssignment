<?php

namespace App\Endpoints;

use App\Tokens;

class Note extends UserEndpoint
{
    private ?int $contentId = null;

    protected function parseQueryParameter(string $method, string $key, string $value): void
    {
        if ($key === 'contentid') {
            $this->contentId = \App\ArgumentParser::parseInt($key, $value, 1, PHP_INT_MAX);
        } else {
            parent::parseQueryParameter($method, $key, $value);
        }
    }

    protected function handleGetRequest(\App\Request $request): ResponseData
    {
        $userId = Tokens::getTokenUserId($request);
        return new ResponseData(
            $this->getDatabase()->getUserNotes($userId, $this->contentId),
            \App\ResponseCode::OK,
            ['Access-Control-Allow-Headers: Authorization']
        );
    }
}
