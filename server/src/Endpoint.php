<?php

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
     * @throws ClientException if the request is invalid
     */
    protected function handleGetRequest(): ResponseData
    {
        throw new ClientException(ResponseCode::METHOD_NOT_ALLOWED);
    }

    // TODO: 2 functions or 1 function with a parameter?
    // TODO: Different endpoints for mutually exclusive parameters?
    /**
     * Parse a GET parameter and check that it is valid
     * @param string $key the lower case name of the parameter
     * @param string $value the value of the parameter
     * @throws ClientException if the parameter is invalid
     */
    protected function parseQueryParameter(string $key, string $value): void
    {
        throw new ClientException(ResponseCode::BAD_REQUEST);
    }

    // TODO: Am i using POST parameters at all? Would also remove Request::bodyParams
    /**
     * Parse a POST parameter and check that it is valid
     * @param string $key the lower case name of the parameter
     * @param string $value the value of the parameter
     * @throws ClientException if the parameter is invalid
     */
    protected function parseBodyParameter(string $key, string $value): void
    {
        throw new ClientException(ResponseCode::BAD_REQUEST);
    }

    private function parseParameters(Request $request): void
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

    final public function handleRequest(Request $request): void
    {
        assert(!$this->handledRequest, "handleRequest called more than once");

        $this->parseParameters($request);

        // TODO: Handle OPTIONS and other methods
        $response = match ($request->getMethod()) {
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
