<?php


namespace Sarnado\Converter\Exceptions;


/**
 * Class UnauthorizedException
 * @package Sarnado\Converter\Exceptions
 */
class UnauthorizedException extends \Exception
{
    /**
     * UnauthorizedException constructor.
     * @param string $message
     */
    public function __construct(string $message = 'Invalid APIClient token')
    {
        parent::__construct($message);
    }
}
