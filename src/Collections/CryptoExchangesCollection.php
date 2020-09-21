<?php


namespace Sarnado\Converter\Collections;


use Sarnado\Converter\Objects\CryptoExchangeObject;
use Tightenco\Collect\Support\Collection;

/**
 * Class CryptoExchangesCollection
 * @package Sarnado\Converter\Collections
 */
class CryptoExchangesCollection extends Collection
{
    /**
     * CryptoRatesCollection constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        if ($this->check($data))
        {
            parent::__construct($data);
        }
        else
        {
            throw new \InvalidArgumentException('Item from array must be instance of CryptoExchangeObject');
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
                if (!($item instanceof CryptoExchangeObject))
                {
                    return false;
                }
            }
        }
        return true;
    }
}
