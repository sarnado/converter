<?php


namespace Sarnado\Converter\Builders;


use Sarnado\Converter\Collections\CryptoRatesCollection;
use Sarnado\Converter\Contracts\CollectionBuilderInterface;

/**
 * Class CryptoRatesCollectionBuilder
 * @package Sarnado\Converter\Builders
 */
class CryptoRatesCollectionBuilder implements CollectionBuilderInterface
{

    /**
     * @param array $data
     * @return CryptoRatesCollection
     */
    public static function build(array $data = []): CryptoRatesCollection
    {
        $result = [];
        if (!empty($data))
        {
            foreach ($data as $exchange => $rates)
            {
                if (!empty($rates))
                {
                    foreach ($rates as $pair => $rate)
                    {
                        $object = CryptoRateObjectBuilder::build($rate);
                        $key = $object->getExchange() . ':' . $object->getCrypto() . '_' . $object->getFiat();
                        $result[$key] = $object;
                    }
                }
            }
        }
        return new CryptoRatesCollection($result);
    }
}
