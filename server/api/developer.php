<?php

// TODO: Is there a better way to include these files?
// TODO: Using this shouldn't require the extension to be .php
// TODO: Document API in postman
require_once "../config/autoloader.php";
require_once "../config/exceptionhandler.php";

$endpoint = new DeveloperEndpoint();
$response = new JsonResponse($endpoint->getData());

$response->outputData();
