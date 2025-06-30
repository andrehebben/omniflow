<?php

namespace Omniflow\\Api;

use Psr\\Log\\LoggerInterface;

class TodoistClient extends BaseClient
{
    public function __construct(string $token, LoggerInterface $logger)
    {
        parent::__construct([
            'base_uri' => 'https://api.todoist.com/rest/v2/',
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Content-Type' => 'application/json'
            ]
        ], $logger);
    }

    // Placeholder methods
    public function createTask(array $data): void
    {
        $this->logger->info('Creating Todoist task', $data);
    }
}
