<?php


namespace Sarnado\Converter\API;

use GuzzleHttp\Client;
use Sarnado\Converter\Exceptions\BadRequestException;
use Sarnado\Converter\Exceptions\ConverterServerErrorException;
use Sarnado\Converter\Exceptions\ReachedRateLimitException;
use Sarnado\Converter\Exceptions\UnauthorizedException;

/**
 * Class APIClient
 * @package Sarnado\Converter\API
 */
class APIClient
{
    /**
     *
     */
    const BASE_URL = 'https://converter.sarnado.club';

    /**
     *
     */
    const API_VERSION = 'v1';

    /**
     * @var Client
     */
    private $httpClient;

    /**
     * APIClient constructor.
     * @param string $apiToken
     */
    public function __construct(string $apiToken)
    {
        $this->httpClient = new Client(['base_uri' => self::BASE_URL . '/' . $apiToken . '/' . self::API_VERSION . '/']);
    }

    /**
     * @return Client
     */
    public function getHttpClient(): Client
    {
        return $this->httpClient;
    }

    /**
     * @param $response
     * @return APIResponse
     * @throws BadRequestException
     * @throws ConverterServerErrorException
     * @throws ReachedRateLimitException
     * @throws UnauthorizedException
     * @throws \Sarnado\Converter\Exceptions\BadAPIResponseException
     * @throws \Sarnado\Converter\Exceptions\DefaultAPIException
     */
    private function transformResponse($response): APIResponse
    {
        return new APIResponse($response->getStatusCode(), $response->getBody());
    }

    /**
     * @return APIResponse
     * @throws BadRequestException
     * @throws ConverterServerErrorException
     * @throws ReachedRateLimitException
     * @throws UnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Sarnado\Converter\Exceptions\BadAPIResponseException
     * @throws \Sarnado\Converter\Exceptions\DefaultAPIException
     */
    public function getAPIUsage(): APIResponse
    {
        $response = $this->httpClient->request('GET', 'usage');
        return $this->transformResponse($response);
    }

    /**
     * @return APIResponse
     * @throws BadRequestException
     * @throws ConverterServerErrorException
     * @throws ReachedRateLimitException
     * @throws UnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Sarnado\Converter\Exceptions\BadAPIResponseException
     * @throws \Sarnado\Converter\Exceptions\DefaultAPIException
     */
    public function getCryptoExchanges(): APIResponse
    {
        $response = $this->httpClient->request('GET', 'exchanges');
        return $this->transformResponse($response);
    }

    /**
     * @param null $crypto
     * @param null $fiat
     * @param null $exchange
     * @return APIResponse
     * @throws BadRequestException
     * @throws ConverterServerErrorException
     * @throws ReachedRateLimitException
     * @throws UnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Sarnado\Converter\Exceptions\BadAPIResponseException
     * @throws \Sarnado\Converter\Exceptions\DefaultAPIException
     */
    public function getCryptoRates($crypto = null, $fiat = null, $exchange = null): APIResponse
    {
        $response = $this->httpClient->request('GET', 'rates/crypto', [
            'query' => [
                'crypto' => $crypto,
                'fiat' => $fiat,
                'exchange' => $exchange
            ]
        ]);
        return $this->transformResponse($response);
    }

    /**
     * @param null $from
     * @param null $to
     * @return APIResponse
     * @throws BadRequestException
     * @throws ConverterServerErrorException
     * @throws ReachedRateLimitException
     * @throws UnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Sarnado\Converter\Exceptions\BadAPIResponseException
     * @throws \Sarnado\Converter\Exceptions\DefaultAPIException
     */
    public function getFiatRates($from = null, $to = null): APIResponse
    {
        $response = $this->httpClient->request('GET', 'rates/fiat', [
            'query' => [
                'from' => $from,
                'to' => $to
            ]
        ]);
        return $this->transformResponse($response);
    }

    /**
     * @return APIResponse
     * @throws BadRequestException
     * @throws ConverterServerErrorException
     * @throws ReachedRateLimitException
     * @throws UnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Sarnado\Converter\Exceptions\BadAPIResponseException
     * @throws \Sarnado\Converter\Exceptions\DefaultAPIException
     */
    public function getCryptoCurrencies(): APIResponse
    {
        $response = $this->httpClient->request('GET', 'currencies/crypto');
        return $this->transformResponse($response);
    }

    /**
     * @return APIResponse
     * @throws BadRequestException
     * @throws ConverterServerErrorException
     * @throws ReachedRateLimitException
     * @throws UnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Sarnado\Converter\Exceptions\BadAPIResponseException
     * @throws \Sarnado\Converter\Exceptions\DefaultAPIException
     */
    public function getFiatCurrencies(): APIResponse
    {
        $response = $this->httpClient->request('GET', 'currencies/fiat');
        return $this->transformResponse($response);
    }
}
