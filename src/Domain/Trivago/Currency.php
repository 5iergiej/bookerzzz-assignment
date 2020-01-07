<?php

namespace Bookerzzz\Domain\Trivago;

use InvalidArgumentException;

final class Currency
{
    public const ALLOWED_CURRENCIES = [
        "USD",
        "EUR"
    ];

    /** @var string */
    private $value;

    /**
     * Currency constructor.
     * @param $value
     */
    public function __construct($value)
    {
        $this->validate($value);
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     * @throws InvalidArgumentException
     */
    private function validate(string $value): void
    {
        if (!in_array(strtoupper($value), self::ALLOWED_CURRENCIES, true)) {
            throw new InvalidArgumentException('Invalid currency');
        }
    }
}