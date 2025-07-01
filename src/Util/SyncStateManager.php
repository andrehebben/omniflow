<?php

namespace Omniflow\Util;

class SyncStateManager
{
    private string $filePath;
    private array $state = [];

    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
        if (file_exists($filePath)) {
            $data = file_get_contents($filePath);
            $this->state = json_decode($data, true) ?: [];
        }
    }

    public function getLastSyncTime(string $key): ?int
    {
        return $this->state[$key] ?? null;
    }

    public function setLastSyncTime(string $key, int $timestamp): void
    {
        $this->state[$key] = $timestamp;
        $this->persist();
    }

    private function persist(): void
    {
        file_put_contents($this->filePath, json_encode($this->state));
    }
}
