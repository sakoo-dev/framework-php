<?php

namespace Core\Testing;

use Core\Kernel\Environment;
use Core\Kernel\Kernel;
use Core\Testing\Traits\AssistantTester;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use PHPUnit\Framework\TestCase as PHPUnitTestCase;

abstract class TestCase extends PHPUnitTestCase
{
	use MockeryPHPUnitIntegration;
	use AssistantTester;

	protected static ?Kernel $kernel = null;

	public static function setUpBeforeClass(): void
	{
		parent::setUpBeforeClass();
		static::$kernel ??= Kernel::run(Environment::Test);
	}
}
