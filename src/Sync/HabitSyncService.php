<?php

namespace Omniflow\\Sync;

use Psr\\Log\\LoggerInterface;

class HabitSyncService
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function sync(): void
    {
        $this->logger->info('HabitSyncService running');
    }
}
