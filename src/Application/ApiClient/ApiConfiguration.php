<?php

namespace Bookerzzz\Application\ApiClient;

use Bookerzzz\Domain\Trivago\Booking;
use GuzzleHttp\Client;

final class ApiConfiguration
{
    /** @var string */
    private $apiKey;

    /** @var string */
    private $endpoint;

    /**
     * ApiConfiguration constructor.
     * @param $apiKey
     * @param $endpoint
     */
    public function __construct(string $apiKey, string $endpoint)
    {
        $this->apiKey = $apiKey;
        $this->endpoint = $endpoint;
    }

    /**
     * @return string
     */
    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    /**
     * @return string
     */
    public function getEndpoint(): string
    {
        return $this->endpoint;
    }
}