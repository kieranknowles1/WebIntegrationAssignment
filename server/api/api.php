<?php

// TODO: Remove this
ini_set('display_errors', '1');

/**
 * This file is the entry point for the API.
 * It is responsible for routing requests to the correct endpoint.
 *
 * @author Kieran Knowles
 * @generated GitHub Copilot was used to assist in writing this code
 */

require_once "../config/autoloader.php";
require_once "../config/exceptionhandler.php";
require_once "../config/settings.php";

/**
 * Get the endpoint for the given URL
 * @throws App\ClientException If the endpoint cannot be found
 */
function getEndpoint(App\Request $request): App\Endpoints\Endpoint
{
    return match($request->getUrl()) {
        "/api/content/country" => new App\Endpoints\Country(App\ChiDatabase::getInstance()),
        "/api/content/preview" => new App\Endpoints\Preview(App\ChiDatabase::getInstance()),
        "/api/content/list" => new App\Endpoints\ContentList(App\ChiDatabase::getInstance()),
        "/api/developer" => new App\Endpoints\Developer(),
        default => throw new App\ClientException(App\ResponseCode::NOT_FOUND),
    };
}

// TODO: Consider using DI to inject the response object here
$request = App\Request::fromGlobals();
$endpoint = getEndpoint($request);
$endpoint->handleRequest($request);
$response = new App\JsonResponse($endpoint);
$response->outputData();
