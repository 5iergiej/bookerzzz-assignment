<?php

namespace Bookerzzz\Application\ApiClient;

use Bookerzzz\Domain\Trivago\Booking;
use Bookerzzz\Domain\Trivago\Price;

class ApiPayloadFactory
{
    /**
     * @param Booking $booking
     * @return array
     */
    public static function createBookingConfirmation(Booking $booking): array
    {
        return [
            'trv_reference' => $booking->getReferenceId(),
            'advertiser_id' => $booking->getAdvertiserId(),
            'hotel' => $booking->getHotelId(),
            'arrival' => $booking->getArrivalDate()->getTimestamp(),
            'departure' => $booking->getDepartureDate()->getTimestamp(),
            'volume' => $booking->getTotalBookingPrice()->getMoney()->getValue(),
            'booking_id' => $booking->getBookingId(),
            'currency' => $booking->getTotalBookingPrice()->getCurrency()->getValue(),
            'booking_date' => $booking->getCreatedAt()->getTimestamp(),
        ];
    }

    /**
     * @param Booking $booking
     * @param Price $refund
     * @return array
     */
    public static function createBookingCancellation(Booking $booking, Price $refund): array
    {
        return [
            'trv_reference' => $booking->getReferenceId(),
            'advertiser_id' => $booking->getAdvertiserId(),
            'hotel' => $booking->getHotelId(),
            'arrival' => $booking->getArrivalDate()->getTimestamp(),
            'departure' => $booking->getDepartureDate()->getTimestamp(),
            'volume' => $booking->getTotalBookingPrice()->getMoney()->getValue(),
            'booking_id' => $booking->getBookingId(),
            'currency' => $booking->getTotalBookingPrice()->getCurrency()->getValue(),
            'booking_date' => $booking->getCreatedAt()->getTimestamp(),
            'refund_amount' => $refund->getMoney()->getValue(),
        ];
    }
}