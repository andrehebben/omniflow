<?php

namespace Omniflow\\Api;

use GuzzleHttp\\Client;
use Psr\\Log\\LoggerInterface;

abstract class BaseClient
{
    protected Client $client;
    protected LoggerInterface $logger;

    public function __construct(array $config, LoggerInterface $logger)
    {
        $this->client = new Client($config);
        $this->logger = $logger;
    }
}
