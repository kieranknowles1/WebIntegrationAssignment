<?php

namespace App\Endpoints;
use App\Tokens;

class Note extends UserEndpoint
{
    protected function handleGetRequest(\App\Request $request): ResponseData
    {
        Tokens::getTokenUserId($request);
        throw new \Exception("Note not implemented");
    }
}
