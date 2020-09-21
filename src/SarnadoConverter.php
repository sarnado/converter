<?php


namespace Sarnado\Converter;


use Sarnado\Converter\API\APIClient;
use Sarnado\Converter\Builders\CryptoCurrenciesCollectionBuilder;
use Sarnado\Converter\Builders\CryptoExchangesCollectionBuilder;
use Sarnado\Converter\Builders\CryptoRateObjectBuilder;
use Sarnado\Converter\Builders\CryptoRatesCollectionBuilder;
use Sarnado\Converter\Builders\FiatCurrenciesCollectionBuilder;
use Sarnado\Converter\Builders\FiatRateObjectBuilder;
use Sarnado\Converter\Builders\FiatRatesCollectionBuilder;
use Sarnado\Converter\Collections\CryptoCurrenciesCollection;
use Sarnado\Converter\Collections\CryptoExchangesCollection;
use Sarnado\Converter\Collections\FiatCurrenciesCollection;
use Sarnado\Converter\Objects\APIUsageObject;

/**
 * Class SarnadoConverter
 * @package Sarnado\Converter
 */
class SarnadoConverter
{
    /**
     * @var APIClient
     */
    private $apiClient;

    /**
     * SarnadoConverter constructor.
     * @param string $apiKey
     */
    public function __construct(string $apiKey)
    {
       $this->apiClient = new APIClient($apiKey);
    }

    /**
     * @return APIUsageObject
     * @throws Exceptions\BadAPIResponseException
     * @throws Exceptions\BadRequestException
     * @throws Exceptions\ConverterServerErrorException
     * @throws Exceptions\DefaultAPIException
     * @throws Exceptions\ReachedRateLimitException
     * @throws Exceptions\UnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getApiUsage(): APIUsageObject
    {
        $result = $this->apiClient->getAPIUsage()->getResult();
        return new APIUsageObject($result['current'], $result['available'], $result['refresh_after']);
    }

    /**
     * @return CryptoExchangesCollection
     * @throws Exceptions\BadAPIResponseException
     * @throws Exceptions\BadRequestException
     * @throws Exceptions\ConverterServerErrorException
     * @throws Exceptions\DefaultAPIException
     * @throws Exceptions\ReachedRateLimitException
     * @throws Exceptions\UnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getCryptoExchanges(): CryptoExchangesCollection
    {
        $result = $this->apiClient->getCryptoExchanges()->getResult();
        return CryptoExchangesCollectionBuilder::build($result);
    }

    /**
     * @param null|string $crypto
     * @param null|string $fiat
     * @param null|string $exchange
     * @return Collections\CryptoRatesCollection|Objects\CryptoRateObject
     * @throws Exceptions\BadAPIResponseException
     * @throws Exceptions\BadRequestException
     * @throws Exceptions\ConverterServerErrorException
     * @throws Exceptions\DefaultAPIException
     * @throws Exceptions\ReachedRateLimitException
     * @throws Exceptions\UnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getCryptoRates($crypto = null, $fiat = null, $exchange = null)
    {
        $result = $this->apiClient->getCryptoRates($crypto, $fiat, $exchange)->getResult();
        if (!is_null($crypto) && !is_null($fiat))
        {
            return CryptoRateObjectBuilder::build($result);
        }
        return CryptoRatesCollectionBuilder::build($result);
    }

    /**
     * @param null|string $from
     * @param null|string $to
     * @return Collections\FiatRatesCollection|Objects\FiatRateObject
     * @throws Exceptions\BadAPIResponseException
     * @throws Exceptions\BadRequestException
     * @throws Exceptions\ConverterServerErrorException
     * @throws Exceptions\DefaultAPIException
     * @throws Exceptions\ReachedRateLimitException
     * @throws Exceptions\UnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getFiatRates($from = null, $to = null)
    {
        $result = $this->apiClient->getFiatRates($from, $to)->getResult();
        if (!is_null($from) && !is_null($to))
        {
            return FiatRateObjectBuilder::build($result);
        }
        return FiatRatesCollectionBuilder::build($result);
    }

    /**
     * @return CryptoCurrenciesCollection
     * @throws Exceptions\BadAPIResponseException
     * @throws Exceptions\BadRequestException
     * @throws Exceptions\ConverterServerErrorException
     * @throws Exceptions\DefaultAPIException
     * @throws Exceptions\ReachedRateLimitException
     * @throws Exceptions\UnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getCryptoCurrencies(): CryptoCurrenciesCollection
    {
        $result = $this->apiClient->getCryptoCurrencies()->getResult();
        return CryptoCurrenciesCollectionBuilder::build($result);
    }


    /**
     * @return FiatCurrenciesCollection
     * @throws Exceptions\BadAPIResponseException
     * @throws Exceptions\BadRequestException
     * @throws Exceptions\ConverterServerErrorException
     * @throws Exceptions\DefaultAPIException
     * @throws Exceptions\ReachedRateLimitException
     * @throws Exceptions\UnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getFiatCurrencies(): FiatCurrenciesCollection
    {
        $result = $this->apiClient->getFiatCurrencies()->getResult();
        return FiatCurrenciesCollectionBuilder::build($result);
    }
}
