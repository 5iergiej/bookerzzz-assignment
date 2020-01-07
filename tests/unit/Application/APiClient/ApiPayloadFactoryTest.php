<?php

use Bookerzzz\Application\ApiClient\ApiPayloadFactory;
use Bookerzzz\Domain\Trivago\Booking;
use Bookerzzz\Domain\Trivago\Currency;
use Bookerzzz\Domain\Trivago\Money;
use Bookerzzz\Domain\Trivago\Price;
use PHPUnit\Framework\TestCase;

class ApiPayloadFactoryTest extends TestCase
{
    public function testValidPayloadIsCreatedForBookingConfirmation(): void
    {
        $arrivalDate = new DateTimeImmutable('+1week');
        $departureDate = new DateTimeImmutable('+2weeks');
        $createdAt = new DateTimeImmutable();

        $booking = Booking::create(
            'bookingId',
            'referenceId',
            'advertiserId',
            'hotelId',
            $arrivalDate,
            $departureDate,
            new Price(new Money(99.99), new Currency('Eur')),
            $createdAt
        );

        $payload = ApiPayloadFactory::createBookingConfirmation($booking);

        $this->assertEquals([
            'trv_reference' => 'referenceId',
            'advertiser_id' => 'advertiserId',
            'hotel' => 'hotelId',
            'arrival' => $arrivalDate->getTimestamp(),
            'departure' => $departureDate->getTimestamp(),
            'volume' => 99.99,
            'booking_id' => 'bookingId',
            'currency' => 'Eur',
            'booking_date' => $createdAt->getTimestamp(),
        ], $payload);
    }

    public function testValidPayloadIsCreatedForBookingCancellation(): void
    {
        $arrivalDate = new DateTimeImmutable('+1week');
        $departureDate = new DateTimeImmutable('+2weeks');
        $createdAt = new DateTimeImmutable();

        $booking = Booking::create(
            'bookingId',
            'referenceId',
            'advertiserId',
            'hotelId',
            $arrivalDate,
            $departureDate,
            new Price(new Money(99.99), new Currency('Eur')),
            $createdAt
        );

        $refund = new Price(
            new Money(10),
            $booking->getTotalBookingPrice()->getCurrency()
        );

        $payload = ApiPayloadFactory::createBookingCancellation($booking, $refund);

        $this->assertEquals([
            'trv_reference' => 'referenceId',
            'advertiser_id' => 'advertiserId',
            'hotel' => 'hotelId',
            'arrival' => $arrivalDate->getTimestamp(),
            'departure' => $departureDate->getTimestamp(),
            'volume' => 99.99,
            'booking_id' => 'bookingId',
            'currency' => 'Eur',
            'booking_date' => $createdAt->getTimestamp(),
            'refund_amount' => $refund->getMoney()->getValue()
        ], $payload);
    }
}