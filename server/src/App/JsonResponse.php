<?php

namespace App;

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
        // Content-Type is meaningless for 204 No Content.
        if ($this->dataSource->getResponseCode() !== ResponseCode::NO_CONTENT) {
            header('Content-Type: application/json');
        }
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

        // 204 must be sent when there is no body and must not be sent when there is a body
        if ($responseCode === ResponseCode::NO_CONTENT && $data !== null) {
            throw new \LogicException("Response code is 204 No Content but data is not null");
        } elseif ($responseCode !== ResponseCode::NO_CONTENT && $data === null) {
            throw new \LogicException("Response code is not 204 No Content but data is null");
        }

        $this->outputHeaders();
        http_response_code($responseCode->value);
        if ($data !== null) {
            echo json_encode($data);
        }
    }
}
