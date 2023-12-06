<?php

namespace App;

/**
 * Data source for a response
 *
 * @author Kieran Knowles
 * @generated GitHub Copilot was used to assist in writing this code
 */
interface DataSource
{
    public function getResponseCode(): ResponseCode;
    public function getData(): mixed;

    /**
     * Get any extra headers that should be sent with the response in addition to the Content-Type header
     * @return string[]
     */
    public function getExtraHeaders(): array;
}
