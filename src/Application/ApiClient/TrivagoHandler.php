<?php

namespace Bookerzzz\Application\ApiClient;

use Bookerzzz\Application\Logger\LoggerInterface;
use Bookerzzz\Domain\Trivago\Booking;
use Bookerzzz\Domain\Trivago\Price;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;

final class TrivagoHandler
{
    /** @var ApiConfiguration */
    private $configuration;

    /** @var LoggerInterface */
    private $logger;

    /**
     * TrivagoHandler constructor.
     * @param ApiConfiguration $configuration
     * @param LoggerInterface $logger
     */
    public function __construct(ApiConfiguration $configuration, LoggerInterface $logger)
    {
        $this->configuration = $configuration;
        $this->logger = $logger;
    }

    /**
     * @param Booking $booking
     * @return bool
     */
    public function confirmBooking(Booking $booking): bool
    {
        try {
            $client = new Client();
            $response = $client->post($this->configuration->getEndpoint(), [
                'headers' => [
                    'X-Trv-Ana-Key' => $this->configuration->getApiKey(),
                ],
                'json' => ApiPayloadFactory::createBookingConfirmation($booking),
            ]);

            return true;
        } catch (ClientException|ServerException $exception) {
            $this->logger->warning($exception->getMessage());
            return false;
        }
    }

    /**
     * @param Booking $booking
     * @param Price $refund
     * @return bool
     */
    public function cancelBooking(Booking $booking, Price $refund): bool
    {
        try {
            $client = new Client();
            $response = $client->post($this->configuration->getEndpoint(), [
                'headers' => [
                    'X-Trv-Ana-Key' => $this->configuration->getApiKey(),
                ],
                'json' => ApiPayloadFactory::createBookingCancellation($booking, $refund),
            ]);

            return true;
        } catch (ClientException|ServerException $exception) {
            $this->logger->warning($exception->getMessage());
            return false;
        }
    }
}