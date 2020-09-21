<?php


namespace Sarnado\Converter\Collections;


use Sarnado\Converter\Objects\CryptoCurrencyObject;
use Tightenco\Collect\Support\Collection;

class CryptoCurrenciesCollection extends Collection
{
    /**
     * CryptoCurrenciesCollection constructor.
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
            throw new \InvalidArgumentException('Item from array must be instance of CryptoCurrencyObject');
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
                if (!($item instanceof CryptoCurrencyObject))
                {
                    return false;
                }
            }
        }
        return true;
    }
}
