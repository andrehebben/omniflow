<?php

namespace Omniflow\Tests\Util;

use Omniflow\Util\LoggerFactory;
use PHPUnit\Framework\TestCase;

class LoggerFactoryTest extends TestCase
{
    public function testCreateReturnsLogger(): void
    {
        $logger = LoggerFactory::create();
        $this->assertInstanceOf(\Psr\Log\LoggerInterface::class, $logger);
    }
}
