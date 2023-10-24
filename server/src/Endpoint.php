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
    /**
     * Check that a GET parameter is valid
     * @param string $key the name of the parameter
     * @param string $value the value of the parameter
     * @param array<string, string> $allGet all GET parameters
     * @param array<string, string> $allBody all POST parameters
     * @throws ClientException if the parameter is invalid
     */
    protected function checkQueryParameter(string $key, string $value, array $allGet, array $allBody): void
    {
        throw new ClientException(ResponseCode::BAD_REQUEST);
    }

    /**
     * Check that a POST parameter is valid
     * @param string $key the name of the parameter
     * @param string $value the value of the parameter
     * @param array<string, string> $allGet all GET parameters
     * @param array<string, string> $allBody all POST parameters
     * @throws ClientException if the parameter is invalid
     */
    protected function checkBodyParameter(string $key, string $value, array $allGet, array $allBody): void
    {
        throw new ClientException(ResponseCode::BAD_REQUEST);
    }

    private function checkParameters(Request $request): void
    {
        $queryParams = $request->getQueryParams();
        $bodyParameters = $request->getBodyParams();

        foreach ($queryParams as $key => $value) {
            $this->checkQueryParameter($key, $value, $queryParams, $bodyParameters);
        }
        foreach ($bodyParameters as $key => $value) {
            $this->checkBodyParameter($key, $value, $queryParams, $bodyParameters);
        }
    }

    final public function handleRequest(Request $request): void
    {
        assert(!$this->handledRequest, "handleRequest called more than once");

        var_dump($request);

        $this->checkParameters($request);

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
