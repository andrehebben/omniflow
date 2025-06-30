<?php

namespace Omniflow\\Util;

use Monolog\\Handler\\StreamHandler;
use Monolog\\Logger;

class LoggerFactory
{
    public static function create(string $name = 'omniflow'): Logger
    {
        $logger = new Logger($name);
        $logger->pushHandler(new StreamHandler('php://stdout'));
        return $logger;
    }
}
