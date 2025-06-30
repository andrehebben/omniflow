<?php

namespace Omniflow\\Api;

use Psr\\Log\\LoggerInterface;

class YouTrackClient extends BaseClient
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

    public function createIssue(array $data): void
    {
        $this->logger->info('Creating YouTrack issue', $data);
    }
}
