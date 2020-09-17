<?php

namespace Sarnado\Converter\Helpers;

class ResultNumberFormatter
{
    const DEFAULT_SCALE = 12;

    const FIAT_BC_SCALE = 5;

    const CRYPTO_BC_SCALE = 8;

    public static function formatFiat($value, int $scale = self::FIAT_BC_SCALE): string
    {
        return self::format($value, $scale);
    }

    public static function formatCrypto($value, int $scale = self::CRYPTO_BC_SCALE): string
    {
        return self::format($value, $scale);
    }

    public static function format($value, int $scale = self::DEFAULT_SCALE): string
    {
        return (string) number_format($value, $scale, '.', '');
    }
}
