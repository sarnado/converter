<?php


namespace Unit;


use PHPUnit\Framework\TestCase;
use Sarnado\Converter\Collections\FiatRatesCollection;
use Sarnado\Converter\Objects\CryptoRateObject;
use Sarnado\Converter\Objects\FiatRateObject;

class FiatRatesCollectionTest extends TestCase
{
    public function providerValidRates(): array
    {
        return [
            [
                [
                    new FiatRateObject('USD', 'RUB', 12345678, '2020-09-12 00:00:00'),
                    new FiatRateObject('USD', 'EUR', 12345, '2020-09-12 00:00:00'),
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
        $collection = new FiatRatesCollection($rates);

        if ($collection->isNotEmpty())
        {
            foreach ($collection as $rate)
            {
                self::assertInstanceOf(FiatRateObject::class, $rate, "Is not valid type");
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
                    new FiatRateObject('USD', 'RUB', 12345678, '2020-09-12 00:00:00'),
                    new FiatRateObject('USD', 'EUR', 12345, '2020-09-12 00:00:00'),
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
        $from = 'USD';
        $to = 'RUB';
        $collection = new FiatRatesCollection($rates);
        $filtered = $collection->filterByPair($from, $to);
        self::assertNotEmpty($filtered);
    }

    public function testFilterByPairWithoutData()
    {
        $from = 'USD';
        $to = 'RUB';
        $collection = new FiatRatesCollection([]);
        $filtered = $collection->filterByPair($from, $to);
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
                    new CryptoRateObject('BTC', 'USD', 12345678, '2020-09-12 00:00:00', 'binance'),
                    new CryptoRateObject('ETH', 'USD', 12345, '2020-09-12 00:00:00', 'binance'),
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
        $collection = new FiatRatesCollection($rates);
    }
}
