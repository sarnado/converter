<?php


namespace Sarnado\Converter\Exceptions;


/**
 * Class DefaultAPIException
 * @package Sarnado\Converter\Exceptions
 */
class DefaultAPIException extends \Exception
{
    /**
     * DefaultAPIException constructor.
     * @param string $message
     */
    public function __construct(string $message = 'Something went wrong')
    {
        parent::__construct($message);
    }
}
