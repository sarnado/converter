<?php


namespace Sarnado\Converter\Builders;


use Sarnado\Converter\Collections\FiatRatesCollection;
use Sarnado\Converter\Contracts\CollectionBuilderInterface;
use Sarnado\Converter\Objects\FiatRateObject;
use Tightenco\Collect\Support\Collection;

/**
 * Class FiatRatesCollectionBuilder
 * @package Sarnado\Converter\Builders
 */
class FiatRatesCollectionBuilder implements CollectionBuilderInterface
{

    /**
     * @param array $data
     * @return Collection
     */
    public static function build(array $data = []): Collection
    {
        $res = [];
        if (!empty($data))
        {
            foreach ($data as $rate)
            {
                if (!isset($rate['rate'], $rate['from'], $rate['to'], $rate['time']))
                {
                    throw new \UnexpectedValueException('Not valid item');
                }
                $key = $rate['from'] . '_' . $rate['to'];
                $result[$key] = new FiatRateObject($rate['from'], $rate['to'], $rate['rate'], $rate['time']);
            }
        }
        return new FiatRatesCollection($res);
    }
}
