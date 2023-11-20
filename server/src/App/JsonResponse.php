<?php

namespace App;

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

    public function __construct(DataSource $dataSource)
    {
        $this->dataSource = $dataSource;
    }

    public function outputData(): void
    {
        // TODO: Handle any other headers
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        http_response_code($this->dataSource->getResponseCode()->value);
        echo json_encode($this->dataSource->getData());
    }
}
