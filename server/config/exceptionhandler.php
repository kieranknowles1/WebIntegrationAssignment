<?php
require_once "autoloader.php";

/**
 * Endpoint to log an exception
 * NOTE: This does not handle setting the response code
 *
 * @generated GitHub Copilot was used to assist in writing this code
 * @author Kieran Knowles
 */
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

/**
 * Convert errors (e.g., undefined variable) to exceptions
 *
 * @generated GitHub Copilot was used to assist in writing this code
 * @author Kieran Knowles
 */
set_error_handler(function (int $severity, string $message, string $file, int $line): void {
    throw new ErrorException($message, 0, $severity, $file, $line);
});
