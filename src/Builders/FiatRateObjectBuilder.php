<?php


namespace Sarnado\Converter\Builders;


use Sarnado\Converter\Contracts\BuilderInterface;
use Sarnado\Converter\Objects\FiatRateObject;

class FiatRateObjectBuilder implements BuilderInterface
{

    public static function build($data): FiatRateObject
    {
        if (!isset($data['rate'], $data['from'], $data['to'], $data['time']))
        {
            throw new \UnexpectedValueException('Not valid item');
        }
        return new FiatRateObject($data['from'], $data['to'], $data['rate'], $data['time']);
    }
}
