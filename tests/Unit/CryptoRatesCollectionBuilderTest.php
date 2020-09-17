<?php

namespace Unit;

use Sarnado\Converter\Builders\CryptoRatesCollectionBuilder;
use PHPUnit\Framework\TestCase;
use Sarnado\Converter\Collections\CryptoRatesCollection;

class CryptoRatesCollectionBuilderTest extends TestCase
{
    const VALID_DATA = array(
        "binance" => array(
            "BTC_USD" => array(
                "rate" => "10888.000000000000",
                "exchange" => "binance",
                "fiat" => "USD",
                "crypto" => "BTC",
                "time" => "2020-09-14T15:19:33.000000Z"
            ),
            "ETH_USD" => array(
                "rate" => "380.180000000000",
                "exchange" => "binance",
                "fiat" => "USD",
                "crypto" => "ETH",
                "time" => "2020-09-14T15:19:33.000000Z"
            ),
        ),
        "bitfinex" => array(
            "BTC_USD" => array(
                "rate" => "10699.000000000000",
                "exchange" => "bitfinex",
                "fiat" => "USD",
                "crypto" => "BTC",
                "time" => "2020-09-14T15:19:33.000000Z"
            ),
            "ETH_USD" => array(
                "rate" => "379.180000000000",
                "exchange" => "bitfinex",
                "fiat" => "USD",
                "crypto" => "ETH",
                "time" => "2020-09-14T15:19:33.000000Z"
            ),
        )
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
        CryptoRatesCollectionBuilder::build(self::INVALID_DATA);
    }

    public function testBuild()
    {
        $collection = CryptoRatesCollectionBuilder::build(self::VALID_DATA);
        self::assertInstanceOf(CryptoRatesCollection::class, $collection);
    }
}
