<?php

namespace App;

/**
 * Data source from an exception
 *
 * @generated GitHub Copilot was used to assist in writing this code
 * @author Kieran Knowles
 */
class ExceptionDataSource implements DataSource
{
    private \Throwable $exception;

    public function __construct(\Throwable $exception)
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
            /** @var ClientException */
            $clientException = $this->exception;
            return [
                'error' => $clientException->getMessage(),
                'detail' => $clientException->getDetail(),
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

    /**
     * @return string[]
     */
    public function getExtraHeaders(): array
    {
        if ($this->exception instanceof ClientException) {
            /** @var ClientException */
            $clientException = $this->exception;
            return $clientException->getHeaders();
        } else {
            return [];
        }
    }
}
