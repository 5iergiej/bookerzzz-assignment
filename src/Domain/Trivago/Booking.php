<?php

namespace Bookerzzz\Domain\Trivago;

use DateTimeImmutable;

final class Booking
{
    /** @var string */
    private $status;

    /** @var string */
    private $bookingId;

    /** @var string */
    private $referenceId;

    /** @var string */
    private $advertiserId;

    /** @var string */
    private $hotelId;

    /** @var DateTimeImmutable */
    private $arrivalDate;

    /** @var DateTimeImmutable */
    private $departureDate;

    /** @var Price */
    private $totalBookingPrice;

    /** @var DateTimeImmutable */
    private $createdAt;

    private function __construct(){
        // see self::create()
    }

    /**
     * @param string $bookingId
     * @param string $referenceId
     * @param string $advertiserId
     * @param string $hotelId
     * @param DateTimeImmutable $arrivalDate
     * @param DateTimeImmutable $departureDate
     * @param Price $totalBookingPrice
     * @param DateTimeImmutable $createdAt
     */
    public static function create(
        string $bookingId,
        string $referenceId,
        string $advertiserId,
        string $hotelId,
        DateTimeImmutable $arrivalDate,
        DateTimeImmutable $departureDate,
        Price $totalBookingPrice,
        DateTimeImmutable $createdAt): self
    {
        $booking = new self();
        $booking->status = 'created';

        $booking->bookingId = $bookingId;
        $booking->referenceId = $referenceId;
        $booking->advertiserId = $advertiserId;
        $booking->hotelId = $hotelId;
        $booking->arrivalDate = $arrivalDate;
        $booking->departureDate = $departureDate;
        $booking->totalBookingPrice = $totalBookingPrice;
        $booking->createdAt = $createdAt;

        return $booking;
    }

    public function cancel(): void
    {
        $this->status = 'cancelled';
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getBookingId(): string
    {
        return $this->bookingId;
    }

    /**
     * @return string
     */
    public function getReferenceId(): string
    {
        return $this->referenceId;
    }

    /**
     * @return string
     */
    public function getAdvertiserId(): string
    {
        return $this->advertiserId;
    }

    /**
     * @return string
     */
    public function getHotelId(): string
    {
        return $this->hotelId;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getArrivalDate(): DateTimeImmutable
    {
        return $this->arrivalDate;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getDepartureDate(): DateTimeImmutable
    {
        return $this->departureDate;
    }

    /**
     * @return Price
     */
    public function getTotalBookingPrice(): Price
    {
        return $this->totalBookingPrice;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }
}