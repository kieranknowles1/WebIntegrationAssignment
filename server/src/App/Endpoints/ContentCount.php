<?php

namespace App\Endpoints;

/**
 * Endpoint to get the number of content items in the CHI database, total and by type
 *
 * @author Kieran Knowles
 * @generated GitHub Copilot was used to assist in writing this code
 */
class ContentCount extends ChiEndpoint
{
    protected function handleGetRequest(\App\Request $request): ResponseData
    {
        $counts = $this->getDatabase()->getContentCounts();
        $total = array_reduce($counts, fn($acc, $count) => $acc + $count['count'], 0);

        return new ResponseData(
            [
                "total" => $total,
                "counts" => $counts
            ],
            \App\ResponseCode::OK
        );
    }

    protected function getSupportedMethods(): array
    {
        return ['GET'];
    }
}
