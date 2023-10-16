<?php

/**
 * Autoload classes in the lib directory
 * Based on @see https://www.php.net/manual/en/language.oop5.autoload.php
 *
 * @generated GitHub Copilot was used to assist in writing this code
 * @author Kieran Knowles
 */
spl_autoload_register(function (string $class): void {
    include __DIR__ . "/../lib/$class.php";
});

class ExceptionEndpoint extends Endpoint {
    private Exception $exception;

    public function __construct(Exception $exception) {
        $this->exception = $exception;
    }

    protected function processRequest(): mixed {
        return [
            'error' => $this->exception->getMessage(),
            'file' => $this->exception->getFile(),
            'line' => $this->exception->getLine(),
            'trace' => $this->exception->getTrace(),
        ];
    }
}

/**
 * Log exceptions as JSON
 *
 * @generated GitHub Copilot was used to assist in writing this code
 * @author Kieran Knowles
 */
set_exception_handler(function (Throwable $exception): void {
    http_response_code(500);
    $endpoint = new ExceptionEndpoint($exception);
    $endpoint->run();
});
