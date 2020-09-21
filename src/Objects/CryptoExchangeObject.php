<?php


namespace Sarnado\Converter\Objects;


/**
 * Class CryptoExchangeObject
 * @package Sarnado\Converter\Objects
 */
class CryptoExchangeObject
{
    /**
     * @var string
     */
    private $name;

    /**
     * CryptoExchangeObject constructor.
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->setName($name);
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
