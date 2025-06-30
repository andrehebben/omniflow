<?php

namespace Omniflow\\Api;

use Psr\\Log\\LoggerInterface;

class GoogleCalendarClient extends BaseClient
{
    public function __construct(string $icsUrl, LoggerInterface $logger)
    {
        parent::__construct([
            'base_uri' => $icsUrl
        ], $logger);
    }

    public function fetchEvents(): array
    {
        $this->logger->info('Fetching Google Calendar events');
        return [];
    }
}
