<?php

namespace Bookerzzz\Domain\Trivago;

use InvalidArgumentException;

class Money
{
    /** @var float */
    private $value;

    /**
     * Money constructor.
     * @param float $value
     */
    public function __construct(float $value)
    {
        $this->validate($value);
        $this->value = $value;
    }

    /**
     * @return float
     */
    public function getValue(): float
    {
        return $this->value;
    }

    /**
     * @param float $value
     * @throws InvalidArgumentException
     */
    private function validate(float $value)
    {
        if ($value < 0) {
            throw new InvalidArgumentException('Money value can not be negative');
        }
    }
}