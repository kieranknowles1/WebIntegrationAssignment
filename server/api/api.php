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

/**
 * Get the endpoint for the given URL
 * @param string $url The pre-processed URL
 * @return Endpoint The endpoint for the given URL
 * @throws ClientException If the endpoint cannot be found
 */
function getEndpoint(Request $request): Endpoint
{
    return match($request->getUrl()) {
        "/api/content/country" => new CountryEndpoint(ChiDatabase::getInstance()),
        "/api/content/preview" => new PreviewEndpoint(ChiDatabase::getInstance()),
        "/api/content/list" => new ContentListEndpoint(ChiDatabase::getInstance()),
        "/api/developer" => new DeveloperEndpoint(),
        default => throw new ClientException(ResponseCode::NOT_FOUND),
    };
}

// TODO: Consider using DI to inject the response object here
$request = Request::fromGlobals();
$endpoint = getEndpoint($request);
$endpoint->handleRequest($request);
$response = new JsonResponse($endpoint);
$response->outputData();
