<?php

namespace Omniflow\Tests\Sync;

use Omniflow\Sync\TaskSyncService;
use PHPUnit\Framework\TestCase;
use Psr\Log\NullLogger;

class TaskSyncServiceTest extends TestCase
{
    public function testSyncRunsWithoutErrors(): void
    {
        $service = new TaskSyncService(new NullLogger());
        $this->expectNotToPerformAssertions();
        $service->sync();
    }
}
