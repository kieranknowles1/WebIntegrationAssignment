<?php

/**
 * Data source from an exception
 *
 * @generated GitHub Copilot was used to assist in writing this code
 * @author Kieran Knowles
 */
class ExceptionDataSource implements DataSource
{
    private Throwable $exception;

    public function __construct(Throwable $exception)
    {
        $this->exception = $exception;
    }

    public function getResponseCode(): ResponseCode
    {
        if ($this->exception instanceof ClientException) {
            /** @var ClientException */
            $clientException = $this->exception;
            return $clientException->getResponseCode();
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
