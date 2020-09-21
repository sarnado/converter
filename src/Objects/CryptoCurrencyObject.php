<?php


namespace Sarnado\Converter\Objects;


/**
 * Class CryptoCurrencyObject
 * @package Sarnado\Converter\Objects
 */
class CryptoCurrencyObject
{
    /**
     * @var string
     */
    private $name;

    /**
     * CryptoCurrencyObject constructor.
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }
}
