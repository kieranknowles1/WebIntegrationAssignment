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
 * Pre-process the URL to a format that can be used to find the endpoint
 * Removes query parameters, trailing slashes, the root path, and converts to lowercase
 * @param string $url The URL to pre-process
 * @return string The pre-processed URL
 */
function preprocessUrl(string $url): string
{
    // TODO: Is this the correct commenting style?
    // Remove query parameters
    $url = parse_url($url, PHP_URL_PATH);

    // Trim any trailing slashes
    $url = rtrim($url, '/');

    // Remove the root path
    $url = preg_replace(API_ROOT_PATTERN, '', $url);

    // Convert to lowercase
    $url = strtolower($url);

    return $url;
}

/**
 * Get the endpoint for the given URL
 * // TODO: Check the request method and support methods other than GET in Endpoint
 * // TODO: Should this be a factory?
 * @param string $url The pre-processed URL
 * @return Endpoint The endpoint for the given URL
 * // TODO: This should return 404 instead of throwing an exception
 * @throws Exception If the endpoint cannot be found
 */
function getEndpoint(string $url): Endpoint
{
    return match($url) {
        "/content/country" => new CountryEndpoint(ChiDatabase::getInstance()),
        "/developer" => new DeveloperEndpoint(),
        default => throw new ClientException(ResponseCode::NOT_FOUND),
    };
}

// TODO: Consider using DI to inject the response object here
$endpoint = getEndpoint(preprocessUrl($_SERVER['REQUEST_URI']));
$endpoint->handleRequest();
$response = new JsonResponse($endpoint);
$response->outputData();
