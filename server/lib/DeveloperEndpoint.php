<?php

/**
 * Endpoint to get developer information
 *
 * @author Kieran Knowles
 * @generated GitHub Copilot was used to assist in writing this code
 */
class DeveloperEndpoint extends Endpoint
{
    protected function handleGetRequest(): mixed
    {
        return [
            'name' => 'Kieran Knowles',
            'student_id' => 'w20013000',
        ];
    }
}
