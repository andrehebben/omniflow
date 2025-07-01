<?php

namespace Omniflow\\Util;

use Dotenv\\Dotenv;
use Omniflow\\Sync\\TaskSyncService;
use Omniflow\\Sync\\HabitSyncService;
use Omniflow\\Sync\\BookSyncService;
use Omniflow\\Sync\\GitHubSyncService;
use Omniflow\\Api\\GitHubClient;
use Omniflow\\Api\\YouTrackClient;
use Omniflow\\Util\\SyncStateManager;

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

        $stateFile = $_ENV['SYNC_STATE_FILE'] ?? __DIR__ . '/../../state.json';

        $gitHub = new GitHubClient($_ENV['GITHUB_API_TOKEN'] ?? '', $logger);
        $youTrack = new YouTrackClient(
            $_ENV['YOUTRACK_BASE_URL'] ?? '',
            $_ENV['YOUTRACK_API_TOKEN'] ?? '',
            $logger
        );
        $state = new SyncStateManager($stateFile);

        $services = [
            new TaskSyncService($logger),
            new HabitSyncService($logger),
            new BookSyncService($logger),
            new GitHubSyncService($gitHub, $youTrack, $state, $logger),
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
