<?php

namespace Bookerzzz\Infrastructure\Logger;

use Bookerzzz\Application\Logger\LoggerInterface;

class SentryLogger implements LoggerInterface
{
    private $client;

    /**
     * SentryLogger constructor.
     */
    public function __construct(string $clientKey)
    {
        // create actual Sentry client, ie:
        // $this->client = new SentryClient($clientKey)
    }

    public function warning(string $message): void
    {
        // TODO: Implement warning() method.
    }

    public function error(string $message): void
    {
        // TODO: Implement error() method.
    }

    public function info(string $message): void
    {
        // TODO: Implement info() method.
    }
}