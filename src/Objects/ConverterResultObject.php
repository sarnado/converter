<?php

namespace Sarnado\Converter\Objects;



use Sarnado\Converter\Checkers\TypeValidator;

/**
 * Class ConverterResultObject
 */
class ConverterResultObject
{
    /**
     * @var string
     */
    private $amount;
    /**
     * @var string
     */
    private $currency;

    /**
     * ConverterResultObject constructor.
     * @param string $amount
     * @param string $currency
     */
    public function __construct(string $amount, string $currency)
    {
        $this->setAmount($amount);
        $this->setCurrency($currency);
    }

    /**
     * @return string
     */
    public function getAmount(): string
    {
        return $this->amount;
    }

    /**
     * @param string $amount
     */
    public function setAmount(string $amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     */
    public function setCurrency(string $currency)
    {
        $this->currency = $currency;
    }

    /**
     * @return string
     */
    public function toString(): string
    {
        return $this->amount . ' ' . $this->currency;
    }
}
