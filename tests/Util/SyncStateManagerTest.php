<?php
namespace Omniflow\Tests\Util;

use Omniflow\Util\SyncStateManager;
use PHPUnit\Framework\TestCase;

class SyncStateManagerTest extends TestCase
{
    public function testStateIsPersisted(): void
    {
        $file = sys_get_temp_dir() . '/state_' . uniqid() . '.json';
        $manager = new SyncStateManager($file);
        $manager->setLastSyncTime('repo', 123);

        $manager2 = new SyncStateManager($file);
        $this->assertSame(123, $manager2->getLastSyncTime('repo'));

        unlink($file);
    }
}
