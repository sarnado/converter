<?php


namespace Unit;


use PHPUnit\Framework\TestCase;
use Sarnado\Converter\Collections\FiatCurrenciesCollection;
use Sarnado\Converter\Objects\CryptoRateObject;
use Sarnado\Converter\Objects\FiatCurrencyObject;

class FiatCurrenciesCollectionTest extends TestCase
{
    public function providerValidRates(): array
    {
        return [
            [
                [
                    new FiatCurrencyObject('USD'),
                    new FiatCurrencyObject('EUR'),
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
        $collection = new FiatCurrenciesCollection($exchanges);

        if ($collection->isNotEmpty())
        {
            foreach ($collection as $exchange)
            {
                self::assertInstanceOf(FiatCurrencyObject::class, $exchange, "Is not valid type");
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
        $collection = new FiatCurrenciesCollection($exchanges);
    }
}
