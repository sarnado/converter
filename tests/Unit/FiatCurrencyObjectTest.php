<?php


namespace Unit;


use PHPUnit\Framework\TestCase;
use Sarnado\Converter\Objects\FiatCurrencyObject;

class FiatCurrencyObjectTest extends TestCase
{
    /**
     * @var FiatCurrencyObject
     */
    private $exchange;

    public function setUp()
    {
        parent::setUp();

        $this->exchange = new FiatCurrencyObject('USD');
    }

    public function test__construct()
    {
        self::assertEquals('USD', $this->exchange->getName());
    }

    public function testSetName()
    {
        $this->exchange->setName('RUB');
        self::assertEquals('RUB', $this->exchange->getName());
    }
}
