<?php
/**
 * Base class for all API endpoints
 *
 * @author Kieran Knowles
 * @generated GitHub Copilot was used to assist in writing this code
 */
abstract class Endpoint
{
    /**
     * Get the data returned by the endpoint
     */
    abstract protected function getData(): mixed;
}
