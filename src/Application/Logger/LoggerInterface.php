<?php

namespace Bookerzzz\Application\Logger;

interface LoggerInterface
{
    /**
     * @param string $message
     */
    public function warning(string $message): void;

    /**
     * @param string $message
     */
    public function error(string $message): void;

    /**
     * @param string $message
     */
    public function info(string $message): void;
}