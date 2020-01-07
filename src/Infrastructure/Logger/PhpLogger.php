<?php

namespace Bookerzzz\Infrastructure\Logger;

use Bookerzzz\Application\Logger\LoggerInterface;

class PhpLogger implements LoggerInterface
{
    /**
     * @inheritDoc
     */
    public function warning(string $message): void
    {
        error_log('[WARNING]: ' . $message);
    }

    /**
     * @inheritDoc
     */
    public function error(string $message): void
    {
        error_log('[ERROR]: ' . $message);
    }

    /**
     * @inheritDoc
     */
    public function info(string $message): void
    {
        error_log('[INFO]: ' . $message);
    }
}