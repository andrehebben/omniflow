<?php

namespace Omniflow\\Sync;

use Omniflow\\Api\\TodoistClient;
use Omniflow\\Api\\YouTrackClient;
use Omniflow\\Api\\HabiticaClient;
use Psr\\Log\\LoggerInterface;

class TaskSyncService
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function sync(): void
    {
        $this->logger->info('TaskSyncService running');
        // Placeholder logic
    }
}
