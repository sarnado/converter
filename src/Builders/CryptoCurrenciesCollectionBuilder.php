<?php


namespace Sarnado\Converter\Builders;


use Sarnado\Converter\Collections\CryptoCurrenciesCollection;
use Sarnado\Converter\Contracts\CollectionBuilderInterface;
use Sarnado\Converter\Objects\CryptoCurrencyObject;

class CryptoCurrenciesCollectionBuilder implements CollectionBuilderInterface
{

    public static function build(array $data): CryptoCurrenciesCollection
    {
        $result = [];
        if (!empty($data))
        {
            foreach ($data as $item)
            {
                if (!is_string($item))
                {
                    throw new \UnexpectedValueException('Not valid item');
                }
                $result[] = new CryptoCurrencyObject($item);
            }
        }
        return new CryptoCurrenciesCollection($result);
    }
}
