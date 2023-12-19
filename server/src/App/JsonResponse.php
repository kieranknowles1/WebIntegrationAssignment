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

    public function outputHeaders(): void
    {
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        http_response_code($this->dataSource->getResponseCode()->value);
        foreach ($this->dataSource->getExtraHeaders() as $header) {
            header($header);
        }
    }

    public function outputData(): void
    {
        $data = $this->dataSource->getData();
        $responseCode = $this->dataSource->getResponseCode();
        $this->outputHeaders();
        http_response_code($responseCode->value);
        if ($data !== null) {
            echo json_encode($data);
        } else {
            if ($responseCode !== ResponseCode::NO_CONTENT) {
                throw new \Exception("Data is null but response code is not 204");
            }
        }
    }
}
