<?php


namespace Sarnado\Converter\Exceptions;


/**
 * Class ReachedRateLimitException
 * @package Sarnado\Converter\Exceptions
 */
class ReachedRateLimitException extends \Exception
{
    /**
     * ReachedRateLimitException constructor.
     * @param string $message
     */
    public function __construct(string $message = 'You have been reached the rate limit.')
    {
        parent::__construct($message);
    }
}
