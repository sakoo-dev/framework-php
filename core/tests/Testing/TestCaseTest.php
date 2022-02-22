<?php

namespace Core\Tests\Testing;

use Core\Container\Container;
use Core\Kernel\Environment;
use Core\Kernel\Kernel;
use Core\Testing\TestCase;

class TestCaseTest extends TestCase
{
	public function test_kernel_is_loaded_properly()
	{
		$this->assertInstanceOf(Kernel::class, self::$kernel);
		$this->assertSame(Environment::Test, self::$kernel->environment);
		$this->assertInstanceOf(Container::class, self::$kernel->container);
		$this->assertGreaterThan(0, self::$kernel->startTime);
	}
}
