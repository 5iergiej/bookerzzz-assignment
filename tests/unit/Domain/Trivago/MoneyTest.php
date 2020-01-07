<?php

use Bookerzzz\Domain\Trivago\Money;
use PHPUnit\Framework\TestCase;

class MoneyTest extends TestCase
{
    public function testMoneyCanBeCreatedWithValueGreaterThanZero(): void
    {
        $money = new Money(1.23);
        $this->assertInstanceOf(Money::class, $money);
        $this->assertEquals(1.23, $money->getValue());
    }

    public function testMoneyCanBeCreatedWithValueEqualsZero(): void
    {
        $money = new Money(0);
        $this->assertInstanceOf(Money::class, $money);
        $this->assertEquals(0, $money->getValue());
    }

    public function testMoneyCanNotBeCreatedWithValueBelowZero(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $money = new Money(-1.23);
    }
}