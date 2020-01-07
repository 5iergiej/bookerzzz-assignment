<?php

namespace Bookerzzz\Application\Storage;

use Bookerzzz\Application\Storage\Exception\EntityNotFoundException;
use Bookerzzz\Application\Storage\Exception\RepositoryException;
use Bookerzzz\Domain\Trivago\Booking;

interface BookingRepository
{
    /**
     * @param string $id
     * @return Booking
     *
     * @throws EntityNotFoundException
     * @throws RepositoryException
     */
    public function get(string $id): Booking;

    /**
     * @param Booking $booking
     *
     * @throws RepositoryException
     */
    public function save(Booking $booking): void;
}