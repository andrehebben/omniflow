<?php

namespace Omniflow\\Api;

use Psr\\Log\\LoggerInterface;

class GitHubClient extends BaseClient
{
    public function __construct(string $token, LoggerInterface $logger)
    {
        parent::__construct([
            'base_uri' => 'https://api.github.com/',
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/vnd.github+json'
            ]
        ], $logger);
    }

    public function createIssue(array $data): void
    {
        $this->logger->info('Creating GitHub issue', $data);
    }
}
