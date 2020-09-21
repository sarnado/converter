<?php


namespace Sarnado\Converter\Collections;


use Sarnado\Converter\Contracts\CollectionBuilderInterface;
use Sarnado\Converter\Objects\FiatCurrencyObject;
use Tightenco\Collect\Support\Collection;

class FiatCurrenciesCollection extends Collection
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
            throw new \InvalidArgumentException('Item from array must be instance of FiatCurrencyObject');
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
                if (!($item instanceof FiatCurrencyObject))
                {
                    return false;
                }
            }
        }
        return true;
    }
}
