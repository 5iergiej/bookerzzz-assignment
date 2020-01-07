<?php

use Bookerzzz\Domain\Trivago\Currency;
use PHPUnit\Framework\TestCase;

class CurrencyTest extends TestCase
{
    /**
     * @dataProvider knownCurrencies
     * @param string $validCurrency
     */
    public function testValidCurrencyCanBeCreatedWithRecognizedValue(string $validCurrency): void
    {
        $currency = new Currency($validCurrency);
        $this->assertInstanceOf(Currency::class, $currency);
    }

    /**
     * @dataProvider unknownCurrencies
     * @param string $invalidCurrency
     */
    public function testValidCurrencyCanNotBeCreatedWithUnrecognizedValue(string $invalidCurrency): void
    {
        $this->expectException(InvalidArgumentException::class);
        $currency = new Currency($invalidCurrency);
    }

    public function knownCurrencies(): array
    {
        return [
            'eur' => ['eur'],
            'EUR' => ['EUR'],
            'usd' => ['usd'],
            'USD' => ['USD'],
        ];
    }

    public function unknownCurrencies(): array
    {
        return [
            'this' => ['this'],
            'is' => ['is'],
            'not' => ['not'],
            'a' => ['a'],
            'known' => ['known'],
            'currency' => ['currency']
        ];

    }
}