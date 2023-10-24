<?php

/**
 * Data source from an exception
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

    public function getResponseCode(): ResponseCode
    {
        if ($this->exception instanceof ClientException) {
            // TODO: Find a way to get the response code from the exception rather than misusing getCode()
            return ResponseCode::from($this->exception->getCode());
        } else {
            return ResponseCode::INTERNAL_SERVER_ERROR;
        }
    }

    public function getData(): mixed
    {
        if ($this->exception instanceof ClientException) {
            // TODO: Should I return more information?
            return [
                'error' => $this->exception->getMessage(),
            ];
        } else {
            // TODO: Should I be returning all this information?
            return [
                'error' => $this->exception->getMessage(),
                'file' => $this->exception->getFile(),
                'line' => $this->exception->getLine(),
                'trace' => $this->exception->getTrace(),
            ];
        }
    }
}