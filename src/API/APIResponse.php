<?php


namespace Sarnado\Converter\API;


use Sarnado\Converter\Exceptions\BadAPIResponseException;
use Sarnado\Converter\Exceptions\BadRequestException;
use Sarnado\Converter\Exceptions\ConverterServerErrorException;
use Sarnado\Converter\Exceptions\DefaultAPIException;
use Sarnado\Converter\Exceptions\ReachedRateLimitException;
use Sarnado\Converter\Exceptions\UnauthorizedException;

/**
 * Class APIResponse
 * @package Sarnado\Converter\API
 */
class APIResponse
{
    /**
     * @var
     */
    private $success;

    /**
     * @var
     */
    private $result;

    /**
     * APIResponse constructor.
     * @param int $statusCode
     * @param string $body
     * @throws ReachedRateLimitException|UnauthorizedException|DefaultAPIException|ConverterServerErrorException|BadRequestException|BadAPIResponseException
     */
    public function __construct(int $statusCode, string $body)
    {
        $parsed = $this->responseParser($statusCode, $body);

        if (!$this->isValidResponseData($parsed))
        {
            throw new BadAPIResponseException();
        }
        $this->setSuccess((bool) $parsed['success']);
        $this->setResult((array) $parsed['result']);
    }

    /**
     * @return bool
     */
    public function getSuccess(): bool
    {
        return $this->success;
    }

    /**
     * @param bool $success
     */
    public function setSuccess(bool $success)
    {
        $this->success = $success;
    }

    /**
     * @return array
     */
    public function getResult(): array
    {
        return $this->result;
    }

    /**
     * @param array $result
     */
    public function setResult(array $result)
    {
        $this->result = $result;
    }


    /**
     * @param int $statusCode
     * @param string $body
     * @return mixed
     * @throws ReachedRateLimitException|UnauthorizedException|DefaultAPIException|ConverterServerErrorException|BadRequestException
     */
    private function responseParser(int $statusCode, string $body)
    {
        switch ($statusCode)
        {
            case 200:
                return json_decode($body, true);

            case 404:
                throw new BadRequestException();

            case 429:
                throw new ReachedRateLimitException();

            case 500:
                throw new ConverterServerErrorException();

            case 401:
                throw new UnauthorizedException();

            default:
                throw new DefaultAPIException($statusCode . ' http response status code');
        }
    }

    /**
     * @param $parsed
     * @return bool
     */
    private function isValidResponseData($parsed): bool
    {
        if (!isset($parsed['success'], $parsed['result']))
        {
            return false;
        }
        return $parsed['success'] === true;
    }
}
