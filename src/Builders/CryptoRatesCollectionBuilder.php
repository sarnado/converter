<?php


namespace Sarnado\Converter\Builders;


use Sarnado\Converter\Collections\CryptoRatesCollection;
use Sarnado\Converter\Contracts\CollectionBuilderInterface;
use Sarnado\Converter\Objects\CryptoRateObject;
use Tightenco\Collect\Support\Collection;

/**
 * Class CryptoRatesCollectionBuilder
 * @package Sarnado\Converter\Builders
 */
class CryptoRatesCollectionBuilder implements CollectionBuilderInterface
{

    /**
     * @param array $data
     * @return Collection
     */
    public static function build(array $data = []): Collection
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
                        if (!isset($rate['rate'], $rate['exchange'], $rate['fiat'], $rate['crypto'], $rate['time']))
                        {
                            throw new \UnexpectedValueException('Not valid item');
                        }
                        $key = $exchange . ':' . $rate['crypto'] . '_' . $rate['fiat'];
                        $result[$key] = new CryptoRateObject($rate['crypto'], $rate['fiat'], $rate['rate'], $rate['time'], $rate['exchange']);
                    }
                }
            }
        }
        return new CryptoRatesCollection($result);
    }
}
