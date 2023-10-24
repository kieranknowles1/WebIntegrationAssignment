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

const API_ROOT_PATTERN = "/^\/api/i";

/**
 * Get the endpoint for the given URL
 * // TODO: Check the request method and support methods other than GET in Endpoint
 * // TODO: Should this be a factory?
 * @param string $url The pre-processed URL
 * @return Endpoint The endpoint for the given URL
 * // TODO: This should return 404 instead of throwing an exception
 * @throws Exception If the endpoint cannot be found
 */
function getEndpoint(Request $request): Endpoint
{
    return match($request->getUrl()) {
        "/content/country" => new CountryEndpoint(ChiDatabase::getInstance()),
        "/developer" => new DeveloperEndpoint(),
        default => throw new ClientException(ResponseCode::NOT_FOUND),
    };
}

// TODO: Consider using DI to inject the response object here
$endpoint = getEndpoint(Request::getInstance());
$endpoint->handleRequest();
$response = new JsonResponse($endpoint);
$response->outputData();
