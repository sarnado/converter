<?php


namespace Unit;


use PHPUnit\Framework\TestCase;
use Sarnado\Converter\Builders\FiatRatesCollectionBuilder;
use Sarnado\Converter\Collections\FiatRatesCollection;

class FiatRatesCollectionBuilderTest extends TestCase
{
    const VALID_DATA = array(
        "USD_EUR" => array(
            "rate" => "0.844060000000",
            "from" => "USD",
            "to" => "EUR",
            "time" => "2020-09-13 16:43:05 UTC"
        ),
        "USD_RUB" => array(
            "rate" => "74.895038000000",
            "from" => "USD",
            "to" => "RUB",
            "time" => "2020-09-13 16:43:06 UTC"
        ),
        "EUR_USD" => array(
            "rate" => "1.184750000000",
            "from" => "EUR",
            "to" => "USD",
            "time" => "2020-09-13 16:43:06 UTC"
        ),
    );

    const INVALID_DATA = array(
        "USD_EUR" => array(
            "rate" => "0.844060000000",
            "from" => "USD",
            "time" => "2020-09-13 16:43:05 UTC"
        ),
        "USD_RUB" => array(
            "rate" => "74.895038000000",
            "to" => "RUB",
            "time" => "2020-09-13 16:43:06 UTC"
        ),
        "EUR_USD" => array(
            "from" => "EUR",
            "to" => "USD",
            "time" => "2020-09-13 16:43:06 UTC"
        ),
    );

    public function testInvalidBuild()
    {
        $this->expectException(\UnexpectedValueException::class);
        FiatRatesCollectionBuilder::build(self::INVALID_DATA);
    }

    public function testBuild()
    {
        $collection = FiatRatesCollectionBuilder::build(self::VALID_DATA);
        self::assertInstanceOf(FiatRatesCollection::class, $collection);
    }
}
