<?php

namespace Omniflow\\Sync;

use Omniflow\\Api\\GitHubClient;
use Omniflow\\Api\\YouTrackClient;
use Omniflow\\Util\\SyncStateManager;
use Psr\\Log\\LoggerInterface;

class GitHubSyncService
{
    private GitHubClient $gitHub;
    private YouTrackClient $youTrack;
    private SyncStateManager $state;
    private LoggerInterface $logger;

    public function __construct(
        GitHubClient $gitHub,
        YouTrackClient $youTrack,
        SyncStateManager $state,
        LoggerInterface $logger
    ) {
        $this->gitHub = $gitHub;
        $this->youTrack = $youTrack;
        $this->state = $state;
        $this->logger = $logger;
    }

    public function sync(): void
    {
        $this->logger->info('GitHubSyncService running');

        $repos = $this->gitHub->listRepositories();
        $projects = $this->youTrack->listProjects();

        foreach ($repos as $repo) {
            if (!in_array($repo, $projects, true)) {
                $this->youTrack->createProject($repo);
            }
        }

        foreach ($projects as $project) {
            if (!in_array($project, $repos, true)) {
                $this->youTrack->deleteProject($project);
            }
        }

        foreach ($repos as $repo) {
            $lastSync = $this->state->getLastSyncTime($repo);
            $ghIssues = $this->gitHub->getIssues($repo, $lastSync);
            foreach ($ghIssues as $issue) {
                $this->youTrack->syncIssue($repo, $issue);
            }

            $ytIssues = $this->youTrack->getIssues($repo);
            foreach ($ytIssues as $issue) {
                $this->gitHub->syncIssue($repo, $issue);
            }

            if ($this->youTrack->hasOpenIssues($repo)) {
                $this->ensureMilestone($repo);
            }

            $this->state->setLastSyncTime($repo, time());
        }
    }

    private function ensureMilestone(string $repo): void
    {
        $this->logger->info('Ensuring milestones for repo', ['repo' => $repo]);
        $title = 'Next Release';
        $this->gitHub->createMilestone($repo, $title);
        $this->youTrack->createMilestone($repo, $title);
    }
}
