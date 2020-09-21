<?php


namespace Sarnado\Converter\Exceptions;


/**
 * Class BadRequestException
 * @package Sarnado\Converter\Exceptions
 */
class BadRequestException extends \Exception
{
    /**
     * BadRequestException constructor.
     * @param string $message
     */
    public function __construct(string $message = 'Invalid url or params provided')
    {
        parent::__construct($message);
    }
}
