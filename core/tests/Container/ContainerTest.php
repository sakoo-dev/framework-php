<?php

namespace Core\Tests\Container;

use Core\Container\Container;
use Core\Testing\TestCase;

class ContainerTest extends TestCase
{
	private Container $container;

	protected function setUp(): void
	{
		parent::setUp();
		$this->container = new Container();
	}

	public function objects()
	{
		yield 'closure' => [fn () => new \stdClass()];
		yield 'class' => [\stdClass::class];
	}

	/** @dataProvider objects */
	public function test_container_can_resolve_interface_binding($object)
	{
		$this->container->bind('class', $object);
		$resolved = $this->container->resolve('class');

		$this->assertInstanceOf(\stdClass::class, $resolved);
		$this->assertNotSame($resolved, $this->container->resolve('class'));

		$this->assertNull($this->container->resolve('something'));
	}

	/** @dataProvider objects */
	public function test_container_can_resolve_singleton_binding($object)
	{
		$this->container->singleton('class', $object);
		$resolved = $this->container->resolve('class');

		$this->assertInstanceOf(\stdClass::class, $resolved);
		$this->assertSame($resolved, $this->container->resolve('class'));

		$this->assertNull($this->container->resolve('something'));
	}
}
