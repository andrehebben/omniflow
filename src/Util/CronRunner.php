<?php

namespace Omniflow\\Util;

use Dotenv\\Dotenv;
use Omniflow\\Sync\\TaskSyncService;
use Omniflow\\Sync\\HabitSyncService;
use Omniflow\\Sync\\BookSyncService;
use Omniflow\\Sync\\GitHubSyncService;

require_once __DIR__ . '/../../vendor/autoload.php';

class CronRunner
{
    public static function run(): void
    {
        if (file_exists(__DIR__ . '/../../.env')) {
            $dotenv = Dotenv::createImmutable(__DIR__ . '/..' . '/..');
            $dotenv->load();
        }

        $logger = LoggerFactory::create();
        $logger->info('Starting sync run');

        $services = [
            new TaskSyncService($logger),
            new HabitSyncService($logger),
            new BookSyncService($logger),
            new GitHubSyncService($logger),
        ];

        foreach ($services as $service) {
            try {
                $service->sync();
            } catch (\Throwable $e) {
                $logger->error('Sync failed: ' . get_class($service) . ' - ' . $e->getMessage());
            }
        }

        $logger->info('Sync run finished');
    }
}

CronRunner::run();
