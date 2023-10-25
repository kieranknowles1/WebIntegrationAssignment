<?php

/**
 * Endpoint to get previews of random content from the CHI database
 * Results are ordered randomly and content without a preview video is excluded
 *
 * @author Kieran Knowles
 * @generated GitHub Copilot was used to assist in writing this code
 */
class PreviewEndpoint extends ChiEndpoint
{
    protected function handleGetRequest(): ResponseData
    {
        // TODO: Handle limit query parameter
        return new ResponseData($this->getDatabase()->getRandomPreviews(PHP_INT_MAX), ResponseCode::OK);
    }
}
