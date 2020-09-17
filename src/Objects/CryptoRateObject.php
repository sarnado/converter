<?php

namespace Sarnado\Converter\Objects;

use InvalidArgumentException;
use Sarnado\Converter\Checkers\TypeValidator;
use Sarnado\Converter\Helpers\ResultNumberFormatter;

/**
 * Class CryptoRateObject
 */
class CryptoRateObject
{
    /**
     * @var string
     */
    private $crypto;
    /**
     * @var string
     */
    private $fiat;
    /**
     * @var int|float
     */
    private $rate;
    /**
     * @var string
     */
    private $time;
    /**
     * @var string
     */
    private $exchange;

    /**
     * @return string
     */
    public function getCrypto(): string
    {
        return $this->crypto;
    }

    /**
     * @param string $crypto
     */
    public function setCrypto(string $crypto)
    {
        $this->crypto = $crypto;
    }

    /**
     * @return string
     */
    public function getFiat(): string
    {
        return $this->fiat;
    }

    /**
     * @param string $fiat
     */
    public function setFiat(string $fiat)
    {
        $this->fiat = $fiat;
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
     * @throws InvalidArgumentException
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
     * @return string
     */
    public function getExchange(): string
    {
        return $this->exchange;
    }

    /**
     * @param string $exchange
     */
    public function setExchange(string $exchange)
    {
        $this->exchange = $exchange;
    }


    public function __construct(string $crypto, string $fiat, $rate, string $time, string $exchange)
    {
        $this->setCrypto($crypto);
        $this->setFiat($fiat);
        $this->setRate($rate);
        $this->setTime($time);
        $this->setExchange($exchange);
    }

    public function convertToCrypto($amount): ConverterResultObject
    {
        TypeValidator::isNum($amount);

        $this->checkRateExists();

        $rate = ResultNumberFormatter::format($this->rate);

        $amount = ResultNumberFormatter::format($amount);

        $res = bcmul($amount, $rate, ResultNumberFormatter::DEFAULT_SCALE);

        return new ConverterResultObject(ResultNumberFormatter::formatCrypto($res), $this->crypto);
    }

    public function convertToFiat($amount): ConverterResultObject
    {
        TypeValidator::isNum($amount);

        $this->checkRateExists();

        $rate = ResultNumberFormatter::format($this->rate);

        $amount = ResultNumberFormatter::format($amount);

        $res = bcdiv($amount, $rate, ResultNumberFormatter::DEFAULT_SCALE);

        return new ConverterResultObject(ResultNumberFormatter::formatFiat($res), $this->fiat);
    }

    private function checkRateExists(): bool
    {
        return true;
    }
}
