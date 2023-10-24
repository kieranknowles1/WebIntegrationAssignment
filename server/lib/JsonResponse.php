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
    private DataSource $dataSource;
    private string $method;

    public function __construct(DataSource $dataSource)
    {
        $this->dataSource = $dataSource;
    }

    public function outputData()
    {
        header('Content-Type: application/json');
        echo json_encode($this->dataSource->getData());
    }
}
