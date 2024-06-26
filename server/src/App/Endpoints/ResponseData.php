<?php

namespace App\Endpoints;

/**
 * Bundled data and status code returned by an endpoint
 *
 * @author Kieran Knowles
 * @generated GitHub Copilot was used to assist in writing this code
 */
class ResponseData
{
    private mixed $data;
    private \App\ResponseCode $code;
    /** @var string[] */
    private array $headers;

    /**
     * @param string[] $headers
     */
    public function __construct(mixed $data, \App\ResponseCode $code, array $headers = [])
    {
        $this->data = $data;
        $this->code = $code;
        $this->headers = $headers;
    }

    public function getData(): mixed
    {
        return $this->data;
    }

    public function getCode(): \App\ResponseCode
    {
        return $this->code;
    }

    /**
     * @return string[]
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }
}
