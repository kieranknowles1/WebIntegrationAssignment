<?php

// TODO: Check parameters and throw if out of expected range. What is the best way to do this?
/**
 * Base class for all API endpoints
 *
 * @author Kieran Knowles
 * @generated GitHub Copilot was used to assist in writing this code
 */
abstract class Endpoint implements DataSource
{
    private mixed $data;
    private ResponseCode $code;
    private bool $handledRequest = false;

    /**
     * Get the data returned by the endpoint
     * @return ResponseData bundled data and status code
     */
    protected function handleGetRequest(): ResponseData
    {
        // TODO: BadMethodException extending ClientException
        throw new ClientException(ResponseCode::METHOD_NOT_ALLOWED);
    }

    final public function handleRequest(): void
    {
        assert(!$this->handledRequest, "handleRequest called more than once");

        // TODO: Centralise the getMethod logic
        // TODO: Handle OPTIONS and other methods
        $response = match ($_SERVER["REQUEST_METHOD"]) {
            "GET" => $this->handleGetRequest(),
            default => throw new ClientException(ResponseCode::METHOD_NOT_ALLOWED),
        };

        $this->data = $response->getData();
        $this->code = $response->getCode();
    }

    public function getResponseCode(): ResponseCode
    {
        assert($this->handledRequest, "getResponseCode called before handleRequest");
        return $this->code;
    }

    public function getData(): mixed
    {
        assert($this->handledRequest, "getData called before handleRequest");
        return $this->data;
    }
}
