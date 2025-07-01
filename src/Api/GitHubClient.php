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

    public function listRepositories(): array
    {
        $this->logger->info('Fetching GitHub repositories');
        return [];
    }

    public function getIssues(string $repo, ?int $since = null): array
    {
        $this->logger->info('Fetching GitHub issues', ['repo' => $repo, 'since' => $since]);
        return [];
    }

    public function syncIssue(string $repo, array $issue): void
    {
        $context = ['repo' => $repo] + $issue;
        $this->logger->info('Synchronizing issue to GitHub', $context);
    }

    public function getMilestones(string $repo): array
    {
        $this->logger->info('Fetching GitHub milestones', ['repo' => $repo]);
        return [];
    }

    public function createMilestone(string $repo, string $title): void
    {
        $this->logger->info('Creating GitHub milestone', ['repo' => $repo, 'title' => $title]);
    }
}
