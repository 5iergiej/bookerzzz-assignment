<?php

namespace Bookerzzz\Domain\Trivago;

final class Price
{
    /** @var Money */
    private $money;

    /** @var Currency */
    private $currency;

    /**
     * Price constructor.
     * @param Money $money
     * @param Currency $currency
     */
    public function __construct(Money $money, Currency $currency)
    {
        $this->money = $money;
        $this->currency = $currency;
    }

    /**
     * @return Money
     */
    public function getMoney(): Money
    {
        return $this->money;
    }

    /**
     * @return Currency
     */
    public function getCurrency(): Currency
    {
        return $this->currency;
    }
}