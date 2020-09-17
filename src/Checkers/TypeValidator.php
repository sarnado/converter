<?php


namespace Sarnado\Converter\Checkers;


class TypeValidator
{
    public static function isNum($amount): bool
    {
        if (!is_numeric($amount))
        {
            throw new \InvalidArgumentException('Must be numeric or string');
        }
        return true;
    }
}
