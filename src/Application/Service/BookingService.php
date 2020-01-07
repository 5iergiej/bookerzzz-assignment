<?php

namespace Bookerzzz\Application\Service;

use Bookerzzz\Application\ApiClient\TrivagoHandler;
use Bookerzzz\Application\Storage\BookingRepository;
use Bookerzzz\Application\Storage\Exception\EntityNotFoundException;
use Bookerzzz\Domain\Trivago\Booking;
use Bookerzzz\Domain\Trivago\Money;
use Bookerzzz\Domain\Trivago\Price;

class BookingService
{
    private const PROVIDER_TRIVAGO = 'Trivago';
    private const PROVIDER_BOOKING = 'Booking.com';
    private const PROVIDER_OTHER = 'Other';

    /** @var BookingRepository */
    private $repository;

    /** @var TrivagoHandler */
    private $trivagoApiClient;

    /**
     * BookingService constructor.
     * @param BookingRepository $repository
     * @param TrivagoHandler $trivagoApiClient
     */
    public function __construct(BookingRepository $repository, TrivagoHandler $trivagoApiClient)
    {
        $this->repository = $repository;
        $this->trivagoApiClient = $trivagoApiClient;
    }

    /**
     * @param mixed ...$params Data coming ie. from a web-form
     *      It should be parsed in order to create a valid booking object
     *      For a pseudocode the data format is not important
     * @param string $provider
     */
    public function createBooking(string $provider, ... $params): void
    {
        try {
            // sample code to create the object
            $booking = Booking::create(... $params);
            $this->repository->save($booking);

            /*
             * this piece of code should be extracted to a separate method (or even class)
             * but as requirements specify only one usecase I will keep it here for now
             */
            switch ($provider) {
                case self::PROVIDER_TRIVAGO:
                    $this->trivagoApiClient->confirmBooking($booking);
                    break;
                case self::PROVIDER_BOOKING:
                    // send request to booking.com api
                    break;
                case self::PROVIDER_OTHER:
                    // handle other providers
                    break;
            }
        } catch (\InvalidArgumentException $exception) {
            // booking can not be created - do something
        } catch (\Throwable $exception) {
            // do something in case of unexpected error
        }
    }

    /**
     * @param string $bookingId
     * @param float $refund
     */
    public function cancelBooking(string $bookingId, float $refund = 0): void
    {
        try {
            $booking = $this->repository->get($bookingId);
            $booking->cancel();
            $this->repository->save($booking);

            // todo: handle the functionality depending on provider (same as during creation)
            $this->trivagoApiClient->cancelBooking(
                $booking,
                new Price(new Money($refund), $booking->getTotalBookingPrice()->getCurrency())
            );
        } catch (EntityNotFoundException $exception) {
            // do something if booking can not be found
        } catch (\Throwable $exception) {
            // do something in case of unexpected error
        }
    }
}