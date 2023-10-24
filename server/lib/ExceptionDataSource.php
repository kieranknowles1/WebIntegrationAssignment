<?php

/**
 * Endpoint to log an exception
 * // TODO: This does not handle setting the response code
 *
 * @generated GitHub Copilot was used to assist in writing this code
 * @author Kieran Knowles
 */
class ExceptionDataSource implements DataSource
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
