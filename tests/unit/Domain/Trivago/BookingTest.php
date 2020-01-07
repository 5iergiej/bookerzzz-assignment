<?php

use Bookerzzz\Domain\Trivago\Booking;
use Bookerzzz\Domain\Trivago\Currency;
use Bookerzzz\Domain\Trivago\Money;
use Bookerzzz\Domain\Trivago\Price;
use PHPUnit\Framework\TestCase;

class BookingTest extends TestCase
{
    public function testCreatedBookingHasAValidState(): void
    {
        $booking = Booking::create(
            'bookingId',
            'referenceId',
            'advertiserId',
            'hotelId',
            new DateTimeImmutable('+1week'),
            new DateTimeImmutable('+2weeks'),
            new Price(new Money(99.99), new Currency('Eur')),
            new DateTimeImmutable()
        );

        $this->assertInstanceOf(Booking::class, $booking);
        $this->assertSame('created', $booking->getStatus());
    }

    public function testCancelledBookingHasAValidState(): void
    {
        $booking = Booking::create(
            'bookingId',
            'referenceId',
            'advertiserId',
            'hotelId',
            new DateTimeImmutable('+1week'),
            new DateTimeImmutable('+2weeks'),
            new Price(new Money(99.99), new Currency('Eur')),
            new DateTimeImmutable()
        );

        $booking->cancel();
        $this->assertSame('cancelled', $booking->getStatus());
    }
}