<?php


namespace Sarnado\Converter\Collections;

use Sarnado\Converter\Objects\CryptoRateObject;
use Tightenco\Collect\Support\Collection;

/**
 * Class CryptoRatesCollection
 * @package Sarnado\Converter\Collections
 */
class CryptoRatesCollection extends Collection
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
            throw new \InvalidArgumentException('Item from array must be instance of CryptoRateObject');
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
                if (!($item instanceof CryptoRateObject))
                {
                    return false;
                }
            }
        }
        return true;
    }

    public function filterByPair(string $crypto, string $fiat): CryptoRatesCollection
    {
        return $this->filter(function (CryptoRateObject $rate) use ($crypto, $fiat)
        {
            return $rate->getCrypto() === $crypto && $rate->getFiat() === $fiat;
        });
    }
}
