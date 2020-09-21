<?php


namespace Sarnado\Converter\Builders;


use Sarnado\Converter\Collections\FiatCurrenciesCollection;
use Sarnado\Converter\Contracts\CollectionBuilderInterface;
use Sarnado\Converter\Objects\FiatCurrencyObject;

/**
 * Class FiatCurrenciesCollectionBuilder
 * @package Sarnado\Converter\Builders
 */
class FiatCurrenciesCollectionBuilder implements CollectionBuilderInterface
{

    /**
     * @param array $data
     * @return FiatCurrenciesCollection
     */
    public static function build(array $data): FiatCurrenciesCollection
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
                $result[] = new FiatCurrencyObject($item);
            }
        }
        return new FiatCurrenciesCollection($result);
    }
}
