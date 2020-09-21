<?php


namespace Unit;


use Sarnado\Converter\Builders\FiatCurrenciesCollectionBuilder;
use Sarnado\Converter\Collections\FiatCurrenciesCollection;

class FiatCurrenciesCollectionBuilderTest extends \PHPUnit\Framework\TestCase
{
    const VALID_DATA = array(
        "RUB",
        "USD"
    );

    const INVALID_DATA = array(
        "binance" => array(
            "BTC_RUB" => array(
                "rate" => "804147.141566297703",
                "exchange" => "binance",
                "crypto" => "BTC",
                "time" => "2020-09-14T15:19:36.000000Z"
            ),
            "BTC_UAH" => array(
                "rate" => "299684.963845086077",
                "fiat" => "UAH",
                "crypto" => "BTC",
                "time" => "2020-09-14T15:19:36.000000Z"
            ),
        ),
        "bitfinex" => array(
            "BTC_USD" => array(
                "rate" => "10699.000000000000",
                "time" => "2020-09-14T15:19:33.000000Z"
            ),
            "ETH_USD" => array(
                "rate" => "379.180000000000",
            ),
        )
    );

    public function testInvalidBuild()
    {
        $this->expectException(\UnexpectedValueException::class);
        FiatCurrenciesCollectionBuilder::build(self::INVALID_DATA);
    }

    public function testBuild()
    {
        $collection = FiatCurrenciesCollectionBuilder::build(self::VALID_DATA);
        self::assertInstanceOf(FiatCurrenciesCollection::class, $collection);
    }
}
