<?php

namespace App\Endpoints;

use App\Tokens;

class Note extends UserEndpoint
{
    private ?int $contentId = null;

    private ?int $noteId = null;

    protected function parseQueryParameter(string $method, string $key, string $value): void
    {
        if ($method === 'GET' && $key === 'contentid') {
            $this->contentId = \App\ArgumentParser::parseInt($key, $value, 1, PHP_INT_MAX);
        } elseif ($method === 'DELETE' && $key === 'noteid') {
            $this->noteId = \App\ArgumentParser::parseInt($key, $value, 1, PHP_INT_MAX);
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

    protected function handlePostRequest(\App\Request $request): ResponseData
    {
        if ($this->contentId === null) {
            throw new \App\ClientException(\App\ResponseCode::BAD_REQUEST, "Missing required query parameter 'contentid'");
        }

        $userId = Tokens::getTokenUserId($request);

        $body = json_decode($request->getBody(), true);
        if ($body === null) {
            throw new \App\ClientException(\App\ResponseCode::BAD_REQUEST, "Request body is not valid JSON");
        }
        if (!is_array($body)) {
            throw new \App\ClientException(\App\ResponseCode::BAD_REQUEST, "Request body expected to be an object");
        }
        if (!isset($body['text'])) {
            throw new \App\ClientException(\App\ResponseCode::BAD_REQUEST, "Missing required field 'text'");
        }
        if (!is_string($body['text'])) {
            throw new \App\ClientException(\App\ResponseCode::BAD_REQUEST, "Field 'text' expected to be a string");
        }

        $id = $this->getDatabase()->createNote(
            $userId,
            $this->contentId,
            $body['text']
        );

        return new ResponseData(
            $id,
            \App\ResponseCode::OK,
        );
    }

    protected function handleDeleteRequest(\App\Request $request): ResponseData
    {
        if ($this->noteId === null) {
            throw new \App\ClientException(\App\ResponseCode::BAD_REQUEST, "Missing required query parameter 'noteid'");
        }

        $userId = Tokens::getTokenUserId($request);

        $this->getDatabase()->deleteNote(
            $userId,
            $this->noteId
        );

        return new ResponseData(
            null,
            \App\ResponseCode::NO_CONTENT,
        );
    }
}
