<?php

require_once "autoloader.php";

/**
 * Log exceptions as JSON
 *
 * @generated GitHub Copilot was used to assist in writing this code
 * @author Kieran Knowles
 */
set_exception_handler(function (Throwable $exception): void {
    $dataSource = new \App\ExceptionDataSource($exception);
    $response = new \App\JsonResponse($dataSource);
    $response->outputData();

    // Open or create the log file
    $logFile = fopen(\Settings::ERROR_LOG_FILE, "a");
    // Can't do much if the log file can't be opened
    if ($logFile !== false) {
        fwrite($logFile, json_encode([
            'timestamp' => time(),
            'message' => $exception->getMessage(),
            'file' => $exception->getFile(),
            'line' => $exception->getLine(),
            'stacktrace' => $exception->getTrace(),
        ]));
        fwrite($logFile, "\n");
        fclose($logFile);
    }
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
