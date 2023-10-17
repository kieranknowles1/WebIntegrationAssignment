<?php

/**
 * Endpoint to log an exception
 * NOTE: This does not handle setting the response code
 *
 * @generated GitHub Copilot was used to assist in writing this code
 * @author Kieran Knowles
 */
class ExceptionEndpoint extends Endpoint
{
    private Exception $exception;

    public function __construct(Exception $exception)
    {
        $this->exception = $exception;
    }

    public function getData(): mixed
    {
        return [
            'error' => $this->exception->getMessage(),
            'file' => $this->exception->getFile(),
            'line' => $this->exception->getLine(),
            'trace' => $this->exception->getTrace(),
        ];
    }
}
