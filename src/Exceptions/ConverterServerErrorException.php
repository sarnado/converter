<?php


namespace Sarnado\Converter\Exceptions;


/**
 * Class ConverterServerErrorException
 * @package Sarnado\Converter\Exceptions
 */
class ConverterServerErrorException extends \Exception
{
    /**
     * ConverterServerErrorException constructor.
     * @param string $message
     */
    public function __construct(string $message = 'Converter APIClient server error')
    {
        parent::__construct($message);
    }
}
