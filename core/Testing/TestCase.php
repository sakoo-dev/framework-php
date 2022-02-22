<?php

namespace Core\Testing;

use Core\Kernel\Environment;
use Core\Kernel\Kernel;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use PHPUnit\Framework\TestCase as PHPUnitTestCase;

abstract class TestCase extends PHPUnitTestCase
{
	use MockeryPHPUnitIntegration;

	protected static ?Kernel $kernel = null;

	public static function setUpBeforeClass(): void
	{
		parent::setUpBeforeClass();
		self::$kernel ??= Kernel::run(Environment::Test);
	}
}
