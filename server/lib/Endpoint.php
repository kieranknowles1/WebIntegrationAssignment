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
    private int $code;
    private bool $handledRequest = false;

    /**
     * Get the data returned by the endpoint
     * @return ResponseData bundled data and status code
     */
    protected function handleGetRequest(): ResponseData
    {
        // TODO: BadMethodException extending ClientException
        throw new Exception("GET requests are not supported for this endpoint");
    }

    final public function handleRequest(): void
    {
        assert(!$this->handledRequest, "handleRequest called more than once");

        $response = null;
        // TODO: Centralise the getMethod logic
        // TODO: Handle OPTIONS and other methods
        switch ($_SERVER["REQUEST_METHOD"]) {
            case "GET": $response = $this->handleGetRequest();
                break;
                // TODO: BadMethodException extending ClientException
            default: throw new Exception("Method not supported");
        }

        $this->data = $response->getData();
        $this->code = $response->getCode();
    }

    public function getResponseCode(): int
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
