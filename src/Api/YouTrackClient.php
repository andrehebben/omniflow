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

    public function listProjects(): array
    {
        $this->logger->info('Fetching YouTrack projects');
        return [];
    }

    public function createProject(string $name): void
    {
        $this->logger->info('Creating YouTrack project', ['name' => $name]);
    }

    public function deleteProject(string $name): void
    {
        $this->logger->info('Deleting YouTrack project', ['name' => $name]);
    }

    public function getIssues(string $project): array
    {
        $this->logger->info('Fetching YouTrack issues', ['project' => $project]);
        return [];
    }

    public function syncIssue(string $project, array $issue): void
    {
        $context = ['project' => $project] + $issue;
        $this->logger->info('Synchronizing issue to YouTrack', $context);
    }

    public function getMilestones(string $project): array
    {
        $this->logger->info('Fetching YouTrack milestones', ['project' => $project]);
        return [];
    }

    public function createMilestone(string $project, string $title): void
    {
        $this->logger->info('Creating YouTrack milestone', ['project' => $project, 'title' => $title]);
    }

    public function hasOpenIssues(string $project): bool
    {
        $this->logger->info('Checking open YouTrack issues', ['project' => $project]);
        return false;
    }
}
