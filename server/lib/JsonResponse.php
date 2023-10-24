<?php

// TODO: Handle setting a status code
// TODO: Set code 204 if there is no data and don't set the Content-Type header
/**
 * A response from an endpoint encoded as JSON
 *
 * @author Kieran Knowles
 * @generated GitHub Copilot was used to assist in writing this code
 */
class JsonResponse
{
    private Endpoint $endpoint;
    private string $method;

    public function __construct(Endpoint $endpoint, string $method)
    {
        $this->endpoint = $endpoint;
        $this->method = $method;
    }

    public function outputData()
    {
        header('Content-Type: application/json');
        echo json_encode($this->endpoint->getData($this->method));
    }
}
