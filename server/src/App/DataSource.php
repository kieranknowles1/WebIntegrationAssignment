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
}
