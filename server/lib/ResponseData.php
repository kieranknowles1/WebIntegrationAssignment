<?php

/**
 * Bundled data and status code returned by an endpoint
 *
 * @author Kieran Knowles
 * @generated GitHub Copilot was used to assist in writing this code
 */
class ResponseData
{
    private mixed $data;
    private int $code;

    public function __construct(mixed $data, int $code)
    {
        $this->data = $data;
        $this->code = $code;
    }

    public function getData(): mixed
    {
        return $this->data;
    }

    public function getCode(): int
    {
        return $this->code;
    }
}
