<?php


namespace Sarnado\Converter\Builders;


use Sarnado\Converter\Collections\CryptoExchangesCollection;
use Sarnado\Converter\Contracts\CollectionBuilderInterface;
use Sarnado\Converter\Objects\CryptoExchangeObject;
use Tightenco\Collect\Support\Collection;

/**
 * Class CryptoExchangesCollectionBuilder
 * @package Sarnado\Converter\Builders
 */
class CryptoExchangesCollectionBuilder implements CollectionBuilderInterface
{

    public static function build(array $data): CryptoExchangesCollection
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
                $result[] = new CryptoExchangeObject($item);
            }
        }
        return new CryptoExchangesCollection($result);
    }
}
