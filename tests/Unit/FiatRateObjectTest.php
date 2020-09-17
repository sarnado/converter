<?php


namespace Unit;


use Sarnado\Converter\Objects\FiatRateObject;

class FiatRateObjectTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var FiatRateObject
     */
    private $rate;

    public function setUp()
    {
        parent::setUp();
        $from = 'USD';
        $to = 'RUB';
        $rate = 80;
        $time = '2020-09-12 00:00:00';
        $this->rate = new FiatRateObject($from, $to, $rate, $time);
    }

    public function test__construct()
    {
        self::assertEquals('USD', $this->rate->getFrom());
        self::assertEquals('RUB', $this->rate->getTo());
        self::assertEquals(80, $this->rate->getRate());
        self::assertEquals('2020-09-12 00:00:00', $this->rate->getTime());
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
    public function testConvertFunc($amount)
    {
        $converted = $this->rate->convert($amount);
        self::assertInternalType('string', $converted->getAmount());
        self::assertEquals($this->rate->getTo(), $converted->getCurrency());
    }

    /**
     * @dataProvider providerValidAmounts
     * @param $amount
     */
    public function testConvertedToStringFunc($amount)
    {
        $converted = $this->rate->convert($amount);
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
        $this->rate->convert($amount);
    }
}
