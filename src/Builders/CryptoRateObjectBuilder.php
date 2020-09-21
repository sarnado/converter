<?php


namespace Sarnado\Converter\Builders;


use Sarnado\Converter\Contracts\BuilderInterface;
use Sarnado\Converter\Objects\CryptoRateObject;

/**
 * Class CryptoRateObjectBuilder
 * @package Sarnado\Converter\Builders
 */
class CryptoRateObjectBuilder implements BuilderInterface
{

    /**
     * @param $data
     * @return CryptoRateObject
     */
    public static function build($data): CryptoRateObject
    {
        if (!isset($data['rate'], $data['exchange'], $data['fiat'], $data['crypto'], $data['time']))
        {
            throw new \UnexpectedValueException('Not valid item');
        }
        return new CryptoRateObject($data['crypto'], $data['fiat'], $data['rate'], $data['time'], $data['exchange']);
    }
}
