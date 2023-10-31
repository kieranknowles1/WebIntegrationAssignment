<?php

// TODO: Remove this
ini_set('display_errors', '1');

/**
 * This file is the entry point for the API.
 * It is responsible for passing the request to the router and outputting the response.
 *
 * @author Kieran Knowles
 * @generated GitHub Copilot was used to assist in writing this code
 */

require_once "../config/autoloader.php";
require_once "../config/exceptionhandler.php";
require_once "../config/settings.php";

// TODO: Consider using DI to inject the response object here
$request = App\Request::fromGlobals();
$endpoint = App\Router::route($request);
$endpoint->handleRequest($request);
$response = new App\JsonResponse($endpoint);
$response->outputData();
