<?php

namespace App\Endpoints;

/**
 * Endpoint to get developer information
 *
 * @author Kieran Knowles
 * @generated GitHub Copilot was used to assist in writing this code
 */
class Developer extends Endpoint
{
    protected function handleGetRequest(\App\Request $request): ResponseData
    {
        return new ResponseData([
            'name' => 'Kieran Knowles',
            'student_id' => 'w20013000',
        ], \App\ResponseCode::OK);
    }
}
