<?php


namespace Unit;


use Sarnado\Converter\Objects\CryptoCurrencyObject;

class CryptoCurrencyObjectTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var CryptoCurrencyObject
     */
    private $exchange;

    public function setUp()
    {
        parent::setUp();

        $this->exchange = new CryptoCurrencyObject('BTC');
    }

    public function test__construct()
    {
        self::assertEquals('BTC', $this->exchange->getName());
    }

    public function testSetName()
    {
        $this->exchange->setName('ETH');
        self::assertEquals('ETH', $this->exchange->getName());
    }
}
