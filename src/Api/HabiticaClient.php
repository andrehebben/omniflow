<?php

namespace Omniflow\\Api;

use Psr\\Log\\LoggerInterface;

class HabiticaClient extends BaseClient
{
    public function __construct(string $userId, string $token, LoggerInterface $logger)
    {
        parent::__construct([
            'base_uri' => 'https://habitica.com/api/v3/',
            'headers' => [
                'x-api-user' => $userId,
                'x-api-key' => $token,
                'Content-Type' => 'application/json'
            ]
        ], $logger);
    }

    public function createTodo(array $data): void
    {
        $this->logger->info('Creating Habitica todo', $data);
    }
}
