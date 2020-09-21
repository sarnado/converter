<?php


namespace Unit;


use Sarnado\Converter\Collections\CryptoCurrenciesCollection;
use Sarnado\Converter\Objects\CryptoCurrencyObject;
use Sarnado\Converter\Objects\CryptoRateObject;

class CryptoCurrenciesCollectionTest extends \PHPUnit\Framework\TestCase
{
    public function providerValidRates(): array
    {
        return [
            [
                [
                    new CryptoCurrencyObject('ETH'),
                    new CryptoCurrencyObject('BTC'),
                ]
            ],
            [[]],
        ];
    }

    /**
     * @dataProvider providerValidRates
     * @param $exchanges
     */
    public function test__construct($exchanges)
    {
        $collection = new CryptoCurrenciesCollection($exchanges);

        if ($collection->isNotEmpty())
        {
            foreach ($collection as $exchange)
            {
                self::assertInstanceOf(CryptoCurrencyObject::class, $exchange, "Is not valid type");
            }
        }
        else
        {
            self::assertTrue($collection->isEmpty());
        }

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
     * @param $exchanges
     */
    public function testInvalidBuild($exchanges)
    {
        $this->expectException(\InvalidArgumentException::class);
        $collection = new CryptoCurrenciesCollection($exchanges);
    }
}
