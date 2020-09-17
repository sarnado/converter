<?php


namespace Sarnado\Converter\Collections;


use Sarnado\Converter\Objects\CryptoRateObject;
use Sarnado\Converter\Objects\FiatRateObject;
use Tightenco\Collect\Support\Collection;

/**
 * Class FiatRatesCollection
 * @package Sarnado\Converter\Collections
 */
class FiatRatesCollection extends Collection
{
    /**
     * FiatRatesCollection constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        if ($this->check($data))
        {
            parent::__construct($data);
        }
        else
        {
            throw new \InvalidArgumentException('Item from array must be instance of FiatRateObject');
        }
    }

    /**
     * @param array $data
     * @return bool
     */
    private function check(array $data): bool
    {
        if (!empty($data))
        {
            foreach ($data as $item)
            {
                if (!($item instanceof FiatRateObject))
                {
                    return false;
                }
            }
        }
        return true;
    }

    public function filterByPair(string $from, string $to): FiatRatesCollection
    {
        return $this->filter(function (FiatRateObject $rate) use ($from, $to)
        {
            return $rate->getFrom() === $from && $rate->getTo() === $to;
        });
    }
}
