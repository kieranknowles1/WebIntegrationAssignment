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

    protected function handlePostRequest(\App\Request $request): ResponseData
    {
        throw new \App\ClientException(\App\ResponseCode::METHOD_NOT_ALLOWED, "POST is not allowed for this endpoint");
    }

    protected function handlePutRequest(\App\Request $request): ResponseData
    {
        throw new \App\ClientException(\App\ResponseCode::METHOD_NOT_ALLOWED, "PUT is not allowed for this endpoint");
    }

    protected function handleDeleteRequest(\App\Request $request): ResponseData
    {
        throw new \App\ClientException(\App\ResponseCode::METHOD_NOT_ALLOWED, "DELETE is not allowed for this endpoint");
    }

    /**
     * Parse a GET parameter and check that it is valid
     * @param string $key the lower case name of the parameter
     * @param string $value the value of the parameter
     * @throws \App\ClientException if the parameter is invalid
     */
    protected function parseQueryParameter(string $method, string $key, string $value): void
    {
        throw new \App\ClientException(\App\ResponseCode::BAD_REQUEST, "Unknown parameter '$key'");
    }

    private function parseParameters(\App\Request $request): void
    {
        $queryParams = $request->getQueryParams();

        foreach ($queryParams as $key => $value) {
            $this->parseQueryParameter($request->getMethod(), strtolower($key), $value);
        }
    }

    protected function handleOptionsRequest(\App\Request $request): ResponseData
    {
        return new ResponseData(null, \App\ResponseCode::OK, [
            'Access-Control-Allow-Headers: Authorization',
            // TODO: Get which methods are allowed from the endpoint
            'Access-Control-Allow-Methods: GET, OPTIONS, POST, PUT, DELETE',
        ]);
    }

    final public function handleRequest(\App\Request $request): void
    {
        assert(!$this->handledRequest, "handleRequest called more than once");

        // Browser sends OPTIONS request before any request with custom headers i.e. Authorization
        // We don't care about any parameters here, so don't parse them
        if ($request->getMethod() !== "OPTIONS") {
            $this->parseParameters($request);
        }

        $response = match ($request->getMethod()) {
            "DELETE" => $this->handleDeleteRequest($request),
            "GET" => $this->handleGetRequest($request),
            "OPTIONS" => $this->handleOptionsRequest($request),
            "POST" => $this->handlePostRequest($request),
            "PUT" => $this->handlePutRequest($request),
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
