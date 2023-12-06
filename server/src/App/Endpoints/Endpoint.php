<?php

namespace App\Endpoints;

/**
 * Base class for all API endpoints
 *
 * @author Kieran Knowles
 * @generated GitHub Copilot was used to assist in writing this code
 */
abstract class Endpoint implements \App\DataSource
{
    private mixed $data;
    private \App\ResponseCode $code;
    private bool $handledRequest = false;

    /** @var string[] */
    private array $headers = [];

    /**
     * Get the data returned by the endpoint
     * @return ResponseData bundled data and status code
     * @throws \App\ClientException if the request is invalid
     */
    protected function handleGetRequest(\App\Request $request): ResponseData
    {
        throw new \App\ClientException(\App\ResponseCode::METHOD_NOT_ALLOWED, "GET is not allowed for this endpoint");
    }

    // TODO: 2 functions or 1 function with a parameter?
    /**
     * Parse a GET parameter and check that it is valid
     * @param string $key the lower case name of the parameter
     * @param string $value the value of the parameter
     * @throws \App\ClientException if the parameter is invalid
     */
    protected function parseQueryParameter(string $key, string $value): void
    {
        throw new \App\ClientException(\App\ResponseCode::BAD_REQUEST, "Unknown parameter '$key'");
    }

    // TODO: Am i using POST parameters at all? Would also remove Request::bodyParams
    /**
     * Parse a POST parameter and check that it is valid
     * @param string $key the lower case name of the parameter
     * @param string $value the value of the parameter
     * @throws \App\ClientException if the parameter is invalid
     */
    protected function parseBodyParameter(string $key, string $value): void
    {
        throw new \App\ClientException(\App\ResponseCode::BAD_REQUEST, "Unknown parameter '$key'");
    }

    private function parseParameters(\App\Request $request): void
    {
        $queryParams = $request->getQueryParams();
        $bodyParameters = $request->getBodyParams();

        foreach ($queryParams as $key => $value) {
            $this->parseQueryParameter(strtolower($key), $value);
        }
        foreach ($bodyParameters as $key => $value) {
            $this->parseBodyParameter(strtolower($key), $value);
        }
    }

    final public function handleRequest(\App\Request $request): void
    {
        assert(!$this->handledRequest, "handleRequest called more than once");

        $this->parseParameters($request);

        // TODO: Handle OPTIONS and other methods
        $response = match ($request->getMethod()) {
            "GET" => $this->handleGetRequest($request),
            default => throw new \App\ClientException(\App\ResponseCode::METHOD_NOT_ALLOWED, "Method '{$request->getMethod()}' is not allowed for this endpoint"),
        };

        $this->data = $response->getData();
        $this->code = $response->getCode();
        $this->headers = $response->getHeaders();
    }

    public function getResponseCode(): \App\ResponseCode
    {
        assert($this->handledRequest, "getResponseCode called before handleRequest");
        return $this->code;
    }

    public function getData(): mixed
    {
        assert($this->handledRequest, "getData called before handleRequest");
        return $this->data;
    }

    public function getExtraHeaders(): array
    {
        assert($this->handledRequest, "getExtraHeaders called before handleRequest");
        return $this->headers;
    }
}
