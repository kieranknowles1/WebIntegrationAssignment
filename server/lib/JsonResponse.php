<?php

// TODO: Should this allow setting the response code?
/**
 * A response from an endpoint encoded as JSON
 *
 * @author Kieran Knowles
 * @generated GitHub Copilot was used to assist in writing this code
 */
class JsonResponse
{
    private Endpoint $endpoint;

    public function __construct(Endpoint $endpoint)
    {
        $this->endpoint = $endpoint;
    }

    public function outputData()
    {
        header('Content-Type: application/json');
        echo json_encode($this->endpoint->getData());
    }
}
