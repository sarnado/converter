<?php


namespace Unit;


use PHPUnit\Framework\TestCase;
use Sarnado\Converter\Builders\CryptoExchangesCollectionBuilder;
use Sarnado\Converter\Collections\CryptoExchangesCollection;

class CryptoExchangesCollectionBuilderTest extends TestCase
{
    const VALID_DATA = array(
        "binance",
        "bitfinex"
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
        CryptoExchangesCollectionBuilder::build(self::INVALID_DATA);
    }

    public function testBuild()
    {
        $collection = CryptoExchangesCollectionBuilder::build(self::VALID_DATA);
        self::assertInstanceOf(CryptoExchangesCollection::class, $collection);
    }
}
