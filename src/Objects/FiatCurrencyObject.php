<?php


namespace Sarnado\Converter\Objects;


class FiatCurrencyObject
{
    /**
     * @var string
     */
    private $name;

    /**
     * FiatCurrencyObject constructor.
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
