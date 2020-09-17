<?php


namespace Unit;


use PHPUnit\Framework\TestCase;
use Sarnado\Converter\Collections\CryptoRatesCollection;
use Sarnado\Converter\Objects\CryptoRateObject;
use Sarnado\Converter\Objects\FiatRateObject;

class CryptoRatesCollectionTest extends TestCase
{

    public function providerValidRates(): array
    {
        return [
            [
                [
                    new CryptoRateObject('BTC', 'USD', 12345678, '2020-09-12 00:00:00', 'binance'),
                    new CryptoRateObject('ETH', 'USD', 12345, '2020-09-12 00:00:00', 'binance'),
                    new CryptoRateObject('BTC', 'USD', 12345678, '2020-09-12 00:00:00', 'bitfinex'),
                    new CryptoRateObject('ETH', 'USD', 12345, '2020-09-12 00:00:00', 'bitfinex'),
                ]
            ],
            [[]],
        ];
    }

    /**
     * @dataProvider providerValidRates
     * @param $rates
     */
    public function test__construct($rates)
    {
        $collection = new CryptoRatesCollection($rates);

        if ($collection->isNotEmpty())
        {
            foreach ($collection as $rate)
            {
                self::assertInstanceOf(CryptoRateObject::class, $rate, "Is not valid type");
            }
        }
        else
        {
            self::assertTrue($collection->isEmpty());
        }

    }

    public function providerNotEmptyValidRates(): array
    {
        return [
            [
                [
                    new CryptoRateObject('BTC', 'USD', 12345678, '2020-09-12 00:00:00', 'binance'),
                    new CryptoRateObject('ETH', 'USD', 12345, '2020-09-12 00:00:00', 'binance'),
                    new CryptoRateObject('BTC', 'USD', 12345678, '2020-09-12 00:00:00', 'bitfinex'),
                    new CryptoRateObject('ETH', 'USD', 12345, '2020-09-12 00:00:00', 'bitfinex'),
                ]
            ]
        ];
    }

    /**
     * @dataProvider providerNotEmptyValidRates
     * @param $rates
     */
    public function testFilterByPairWithData($rates)
    {
        $crypto = 'BTC';
        $fiat = 'USD';
        $collection = new CryptoRatesCollection($rates);
        $filtered = $collection->filterByPair($crypto, $fiat);
        self::assertNotEmpty($filtered);
    }

    public function testFilterByPairWithoutData()
    {
        $crypto = 'BTC';
        $fiat = 'USD';
        $collection = new CryptoRatesCollection([]);
        $filtered = $collection->filterByPair($crypto, $fiat);
        self::assertEmpty($filtered);
    }

    public function providerInvalidRates(): array
    {
        return [
            [[123, 231, 2423]],
            [['asdsad']],
            [
                [
                    new \stdClass(),
                    new \stdClass(),
                    new \stdClass(),
                ]
            ],
            [
                [
                    new FiatRateObject('USD', 'RUB', 12345678, '2020-09-12 00:00:00'),
                    new FiatRateObject('USD', 'EUR', 12345, '2020-09-12 00:00:00'),
                ]
            ]
        ];
    }

    /**
     * @dataProvider providerInvalidRates
     * @param $rates
     */
    public function testInvalidBuild($rates)
    {
        $this->expectException(\InvalidArgumentException::class);
        $collection = new CryptoRatesCollection($rates);
    }
}
