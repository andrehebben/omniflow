<?php

namespace Omniflow\\Api;

use Psr\\Log\\LoggerInterface;

class HomeAssistantClient extends BaseClient
{
    public function __construct(string $baseUrl, string $token, LoggerInterface $logger)
    {
        parent::__construct([
            'base_uri' => rtrim($baseUrl, '/') . '/api/',
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Content-Type' => 'application/json'
            ]
        ], $logger);
    }

    public function sendEvent(string $event, array $data = []): void
    {
        $this->logger->info('Sending Home Assistant event ' . $event, $data);
    }
}
