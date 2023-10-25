<?php

/**
 * Class for exceptions that are caused by the client e.g., invalid request and not found
 * // TODO: Should probably be providing more information to the client
 *
 * @author Kieran Knowles
 * @generated GitHub Copilot was used to assist in writing this code
 */
class ClientException extends RuntimeException
{
    public function __construct(ResponseCode $code)
    {
        parent::__construct(ResponseCode::getMessage($code));
        // TODO: Can I cast in ExceptionDataSource instead?
        $this->code = $code->value;
    }
}
