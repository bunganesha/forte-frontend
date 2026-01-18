<?php

namespace App\Exceptions;

use Exception;

/**
 * ResourceNotFoundException: Exception untuk resource yang tidak ditemukan
 */
class ResourceNotFoundException extends Exception
{
    protected $code = 404;

    public function __construct(string $resource = 'Resource', string $message = '')
    {
        $defaultMessage = "{$resource} not found";
        parent::__construct($message ?: $defaultMessage, $this->code);
    }
}
