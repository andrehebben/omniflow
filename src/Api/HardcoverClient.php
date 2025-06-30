<?php

namespace Omniflow\\Api;

use Psr\\Log\\LoggerInterface;

class HardcoverClient extends BaseClient
{
    public function __construct(string $token, LoggerInterface $logger)
    {
        parent::__construct([
            'base_uri' => 'https://api.hardcover.app/',
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Content-Type' => 'application/json'
            ]
        ], $logger);
    }

    public function getReadingList(): array
    {
        $this->logger->info('Fetching reading list');
        return [];
    }
}
