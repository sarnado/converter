<?php

namespace Unit;

use PHPUnit\Framework\TestCase;
use Sarnado\Converter\Objects\CryptoRateObject;

class CryptoRateObjectTest extends TestCase
{
    /**
     * @var CryptoRateObject
     */
    private $rate;

    protected function setUp()
    {
        parent::setUp();
        $crypto = 'BTC';
        $fiat = 'USD';
        $rate = 10000;
        $time = '2020-09-12 00:00:00';
        $exchange = 'bitfinex';
        $this->rate = new CryptoRateObject($crypto, $fiat, $rate, $time, $exchange);
    }

    public function test__construct()
    {
        self::assertEquals('BTC', $this->rate->getCrypto());
        self::assertEquals('USD', $this->rate->getFiat());
        self::assertEquals(10000, $this->rate->getRate());
        self::assertEquals('2020-09-12 00:00:00', $this->rate->getTime());
        self::assertEquals('bitfinex', $this->rate->getExchange());
    }


    public function testSetRate()
    {
        $this->rate->setRate(10000);
        self::assertInternalType('int', $this->rate->getRate());
        $this->rate->setRate(10000.5);
        self::assertInternalType('float', $this->rate->getRate());
    }

    public function providerInvalidAmounts(): array
    {
        return [
            [[]],
            [['123']],
            [[123.123]],
            [new \stdClass()],
            ['asdqwe'],
            [true],
            [''],
            [null]
        ];
    }

    /**
     * @param $rate
     * @dataProvider providerInvalidAmounts
     */
    public function testSetInvalidRate($rate)
    {
        $this->expectException(\Throwable::class);
        $this->rate->setRate($rate);
    }

    public function providerValidAmounts(): array
    {
        return [
            [123],
            ['123'],
            [123.123],
        ];
    }

    /**
     * @dataProvider providerValidAmounts
     * @param $amount
     */
    public function testConvertToCrypto($amount)
    {
        $converted = $this->rate->convertToCrypto($amount);
        self::assertInternalType('string', $converted->getAmount());
        self::assertEquals($this->rate->getCrypto(), $converted->getCurrency());
    }

    /**
     * @dataProvider providerValidAmounts
     * @param $amount
     */
    public function testConvertedToCryptoToStringFunc($amount)
    {
        $converted = $this->rate->convertToCrypto($amount);
        $value = $converted->getAmount() . ' ' . $converted->getCurrency();
        self::assertEquals($value, $converted->toString());
    }

    /**
     * @param $amount
     * @dataProvider providerInvalidAmounts
     */
    public function testInvalidAmountToCryptoConversion($amount)
    {
        $this->expectException(\Throwable::class);
        $this->rate->convertToCrypto($amount);
    }

    /**
     * @dataProvider providerValidAmounts
     * @param $amount
     */
    public function testConvertToFiat($amount)
    {
        $converted = $this->rate->convertToFiat($amount);
        self::assertInternalType('string', $converted->getAmount());
        self::assertEquals($this->rate->getFiat(), $converted->getCurrency());
    }

    /**
     * @dataProvider providerValidAmounts
     * @param $amount
     */
    public function testConvertedToFiatToStringFunc($amount)
    {
        $converted = $this->rate->convertToFiat($amount);
        $value = $converted->getAmount() . ' ' . $converted->getCurrency();
        self::assertEquals($value, $converted->toString());
    }

    /**
     * @param $amount
     * @dataProvider providerInvalidAmounts
     */
    public function testInvalidAmountToFiatConversion($amount)
    {
        $this->expectException(\Throwable::class);
        $this->rate->convertToFiat($amount);
    }
}
