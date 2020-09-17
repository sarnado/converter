<?php

namespace Sarnado\Converter\Objects;

use Sarnado\Converter\Checkers\TypeValidator;
use Sarnado\Converter\Helpers\ResultNumberFormatter;

/**
 * Class FiatRateObject
 */
class FiatRateObject
{
    /**
     * @var string
     */
    private $from;
    /**
     * @var string
     */
    private $to;
    /**
     * @var float|int
     */
    private $rate;
    /**
     * @var string
     */
    private $time;

    /**
     * FiatRateObject constructor.
     * @param string $from
     * @param string $to
     * @param float|int $rate
     * @param string $time
     */
    public function __construct(string $from, string $to, $rate, string $time)
    {
        $this->setFrom($from);
        $this->setTo($to);
        $this->setRate($rate);
        $this->setTime($time);
    }

    /**
     * @return string
     */
    public function getFrom(): string
    {
        return $this->from;
    }

    /**
     * @param string $from
     */
    public function setFrom(string $from)
    {
        $this->from = $from;
    }

    /**
     * @return string
     */
    public function getTo(): string
    {
        return $this->to;
    }

    /**
     * @param string $to
     */
    public function setTo(string $to)
    {
        $this->to = $to;
    }

    /**
     * @return float|int
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * @param float|int $rate
     */
    public function setRate($rate)
    {
        TypeValidator::isNum($rate);

        $this->rate = $rate;
    }

    /**
     * @return string
     */
    public function getTime(): string
    {
        return $this->time;
    }

    /**
     * @param string $time
     */
    public function setTime(string $time)
    {
        $this->time = $time;
    }

    /**
     * @param $amount
     * @return ConverterResultObject
     */
    public function convert($amount): ConverterResultObject
    {
        TypeValidator::isNum($amount);

        $amount = ResultNumberFormatter::format($amount);

        $rate = ResultNumberFormatter::format($this->rate);

        $res = bcmul($amount, $rate, ResultNumberFormatter::DEFAULT_SCALE);

        return new ConverterResultObject(ResultNumberFormatter::formatFiat($res), $this->to);
    }
}
