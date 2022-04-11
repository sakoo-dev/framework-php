<?php

namespace Core\Tests\Container;

use Core\Container\Container;
use Core\Container\ContainerNotFoundException;
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

	public function test_it_instantiate_class_properly()
	{
		$this->assertInstanceOf(\stdClass::class, $this->container->new(\stdClass::class));

		$this->assertNull($this->container->new('something'));
		$this->assertNull($this->container->new(10));
	}

	public function test_it_resolves_abstractions()
	{
		$this->container->bind(TestInterface::class, SomeClass::class);
		$resolved = $this->container->resolve(TestClass::class);

		$this->assertInstanceOf(SomeClass::class, $resolved->first);
		$this->assertNull($resolved->second);
		$this->assertEquals('', $resolved->third);
		$this->assertEquals(0, $resolved->fourth);
		$this->assertEquals('Default Value', $resolved->fifth);
	}

	public function test_psr_11_the_has_function_works_properly()
	{
		$this->assertFalse($this->container->has('binded'));
		$this->container->bind('binded', \stdClass::class);
		$this->assertTrue($this->container->has('binded'));

		$this->assertFalse($this->container->has('singletoned'));
		$this->container->singleton('singletoned', \stdClass::class);
		$this->assertTrue($this->container->has('singletoned'));
	}

	public function test_prs_11_the_get_function_works_properly()
	{
		$this->expectException(ContainerNotFoundException::class);
		$this->container->get('something');

		$this->container->bind('something', \stdClass::class);
		$this->assertInstanceOf(\stdClass::class, $this->container->get('something'));
	}
}

class TestClass
{
	public function __construct(
		public TestInterface $first,
		public $second,
		public string $third,
		public int $fourth,
		public $fifth = 'Default Value',
	) {
	}
}

class SomeClass implements TestInterface
{
}

interface TestInterface
{
}
