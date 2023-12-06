<?php

namespace App;

/**
 * Class for exceptions that are caused by the client e.g., invalid request and not found
 *
 * @author Kieran Knowles
 * @generated GitHub Copilot was used to assist in writing this code
 */
class ClientException extends \RuntimeException
{
    private ResponseCode $responseCode;
    private string $detail;

    /** @var string[] */
    private array $headers;

    /**
     * @param string[] $headers
     */
    public function __construct(ResponseCode $code, string $detail, array $headers = [])
    {
        parent::__construct(ResponseCode::getMessage($code));

        $this->responseCode = $code;
        $this->detail = $detail;
        $this->headers = $headers;
    }

    /** Get the HTTP response code of the exception */
    public function getResponseCode(): ResponseCode
    {
        return $this->responseCode;
    }

    public function getDetail(): string
    {
        return $this->detail;
    }

    /**
     * @return string[]
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }
}
