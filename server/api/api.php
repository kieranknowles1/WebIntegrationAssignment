<?php

/**
 * This file is the entry point for the API.
 * It is responsible for passing the request to the router and outputting the response.
 *
 * @author Kieran Knowles
 * @generated GitHub Copilot was used to assist in writing this code
 */

require_once "../config/settings.php";
require_once "../config/autoloader.php";
require_once "../config/exceptionhandler.php";

try {
    $request = App\Request::fromGlobals();
    $endpoint = App\Router::route($request);
    $endpoint->handleRequest($request);
    $response = new App\JsonResponse($endpoint);
    $response->outputData();
} catch (App\ClientException $e) {
    $response = new App\JsonResponse(new App\ExceptionDataSource($e));
    $response->outputData();
}
// Other exceptions (500) are handled by the exception handler
