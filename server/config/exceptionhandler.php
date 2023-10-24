<?php

require_once "autoloader.php";

/**
 * Log exceptions as JSON
 *
 * @generated GitHub Copilot was used to assist in writing this code
 * @author Kieran Knowles
 */
set_exception_handler(function (Throwable $exception): void {
    http_response_code(500);
    $endpoint = new ExceptionEndpoint($exception);
    // TODO: Centralise access to the response object and $_SERVER
    // TODO: This isn't really an endpoint. See comment in ExceptionEndpoint.php
    $response = new JsonResponse($endpoint, "GET");
    $response->outputData();
});

/**
 * Convert errors (e.g., undefined variable) to exceptions
 *
 * @generated GitHub Copilot was used to assist in writing this code
 * @author Kieran Knowles
 */
set_error_handler(function (int $severity, string $message, string $file, int $line): void {
    throw new ErrorException($message, 0, $severity, $file, $line);
});
