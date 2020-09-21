<?php


namespace Sarnado\Converter\Objects;


/**
 * Class APIUsageObject
 * @package Sarnado\Converter\Objects
 */
class APIUsageObject
{
    /**
     * @var int
     */
    private $current;
    /**
     * @var int
     */
    private $available;
    /**
     * @var int
     */
    private $refreshAfter;

    /**
     * APIUsageObject constructor.
     * @param int $current
     * @param int $available
     * @param int $refreshAfter
     */
    public function __construct(int $current, int $available, int $refreshAfter)
    {
        $this->setCurrent($current);
        $this->setAvailable($available);
        $this->setRefreshAfter($refreshAfter);
    }

    /**
     * @return int
     */
    public function getCurrent(): int
    {
        return $this->current;
    }

    /**
     * @param int $current
     */
    public function setCurrent(int $current)
    {
        $this->current = $current;
    }

    /**
     * @return int
     */
    public function getAvailable(): int
    {
        return $this->available;
    }

    /**
     * @param int $available
     */
    public function setAvailable(int $available)
    {
        $this->available = $available;
    }

    /**
     * @return int
     */
    public function getRefreshAfter(): int
    {
        return $this->refreshAfter;
    }

    /**
     * @param int $refreshAfter
     */
    public function setRefreshAfter(int $refreshAfter)
    {
        $this->refreshAfter = $refreshAfter;
    }
}
