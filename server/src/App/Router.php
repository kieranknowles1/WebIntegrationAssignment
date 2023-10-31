<?php

namespace App;

/**
 * Class for routing requests to the correct endpoint
 *
 * @author Kieran Knowles
 * @generated GitHub Copilot was used to assist in writing this code
 */
class Router
{
    /**
     * Get the endpoint for the given URL
     * @throws ClientException If the endpoint cannot be found
     */
    public static function route(Request $request): Endpoints\Endpoint
    {
        return match($request->getUrl()) {
            \Settings::API_ROOT . "content/country" => new Endpoints\Country(ChiDatabase::getInstance()),
            \Settings::API_ROOT . "content/preview" => new Endpoints\Preview(ChiDatabase::getInstance()),
            \Settings::API_ROOT . "content/list" => new Endpoints\ContentList(ChiDatabase::getInstance()),
            \Settings::API_ROOT . "developer" => new Endpoints\Developer(),
            default => throw new ClientException(ResponseCode::NOT_FOUND, "The endpoint {$request->getUrl()} does not exist."),
        };
    }

}
