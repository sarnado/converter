<?php


namespace Unit;


use PHPUnit\Framework\TestCase;
use Sarnado\Converter\Objects\CryptoExchangeObject;

class CryptoExchangeObjectTest extends TestCase
{
    /**
     * @var CryptoExchangeObject
     */
    private $exchange;

    public function setUp()
    {
        parent::setUp();

        $this->exchange = new CryptoExchangeObject('bitfinex');
    }

    public function test__construct()
    {
        self::assertEquals('bitfinex', $this->exchange->getName());
    }

    public function testSetName()
    {
        $this->exchange->setName('binance');
        self::assertEquals('binance', $this->exchange->getName());
    }
}
