<?php

// TODO: Should this accept an endpoint instead of data?
/**
 * A response from an endpoint encoded as JSON
 *
 * @author Kieran Knowles
 * @generated GitHub Copilot was used to assist in writing this code
 */
class JsonResponse
{
    private mixed $data;

    public function __construct(mixed $data)
    {
        $this->data = $data;
    }

    public function outputData()
    {
        header('Content-Type: application/json');
        echo json_encode($this->data);
    }
}
