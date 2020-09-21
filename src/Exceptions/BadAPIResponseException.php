<?php


namespace Sarnado\Converter\Exceptions;


/**
 * Class BadAPIResponseException
 * @package Sarnado\Converter\Exceptions
 */
class BadAPIResponseException extends \Exception
{
    /**
     * BadAPIResponseException constructor.
     * @param string $message
     */
    public function __construct(string $message = 'Invalid data from API')
    {
        parent::__construct($message);
    }
}
