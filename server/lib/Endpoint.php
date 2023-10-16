<?php
/**
 * Base class for all API endpoints
 *
 * @author Kieran Knowles
 * @generated GitHub Copilot was used to assist in writing this code
 */
abstract class Endpoint {
    /**
     * Process the request. This must be implemented by the child class to do any per-endpoint processing
     */
    protected abstract function processRequest(): mixed;

    /**
     * Run the endpoint, echoing the result.
     */
    public function run(): void {
        header('Content-Type: application/json');
        $result = $this->processRequest();
        echo json_encode($result);
    }
}
