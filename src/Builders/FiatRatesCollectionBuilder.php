<?php


namespace Sarnado\Converter\Builders;


use Sarnado\Converter\Collections\FiatRatesCollection;
use Sarnado\Converter\Contracts\CollectionBuilderInterface;

/**
 * Class FiatRatesCollectionBuilder
 * @package Sarnado\Converter\Builders
 */
class FiatRatesCollectionBuilder implements CollectionBuilderInterface
{

    /**
     * @param array $data
     * @return FiatRatesCollection
     */
    public static function build(array $data = []): FiatRatesCollection
    {
        $res = [];
        if (!empty($data))
        {
            foreach ($data as $rate)
            {
                $object = FiatRateObjectBuilder::build($rate);
                $key = $object->getFrom() . '_' . $object->getTo();
                $result[$key] = $object;
            }
        }
        return new FiatRatesCollection($res);
    }
}
