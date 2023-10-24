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

    public function getResponseCode(): int
    {
        if ($this->exception instanceof ClientException) {
            return $this->exception->getCode();
        } else {
            return 500;
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
