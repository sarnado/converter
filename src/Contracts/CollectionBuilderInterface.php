<?php

namespace Sarnado\Converter\Contracts;


use Tightenco\Collect\Support\Collection;

/**
 * Interface CollectionBuilderInterface
 * @package Sarnado\Converter\Contracts
 */
interface CollectionBuilderInterface
{
    /**
     * @param array $data
     * @return Collection
     */
    public static function build(array $data);
}
