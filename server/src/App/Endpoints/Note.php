<?php

namespace App\Endpoints;
use App\Tokens;

class Note extends UserEndpoint
{
    protected function handleGetRequest(\App\Request $request): ResponseData
    {
        $userId = Tokens::getTokenUserId($request);
        return new ResponseData(
            $this->getDatabase()->getUserNotes($userId),
            \App\ResponseCode::OK
        );
    }
}
