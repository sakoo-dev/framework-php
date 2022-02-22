<?php

namespace Core\Tests\Container;

use Core\Collection\Collection;
use Core\Testing\TestCase;

class CollectionTest extends TestCase
{
	private Collection $collection;

	protected function setUp(): void
	{
		parent::setUp();

		$this->collection = arr([
			'key' => 'value',
			'foo' => 'dev',
		]);
	}

	public function test_it_is_instance_of_collection()
	{
		$this->assertInstanceOf(Collection::class, $this->collection);
	}

	public function test_it_can_get_using_property()
	{
		$this->assertEquals('value', $this->collection->key);
		$this->assertEquals('dev', $this->collection->foo);

		$this->assertNull($this->collection->else);
	}

	public function test_it_can_set_using_property()
	{
		$this->collection->key = 'Key Value';
		$this->assertEquals('Key Value', $this->collection->key);

		$this->collection->new = 'New Value';
		$this->assertEquals('New Value', $this->collection->new);
	}

	public function test_it_can_return_key_exists()
	{
		$this->assertTrue($this->collection->exists('key'));

		$this->assertFalse($this->collection->exists('thing'));
	}

	public function test_it_can_return_collection_count()
	{
		$this->assertEquals(2, $this->collection->count());

		$this->assertEquals(0, arr([])->count());
	}

	public function test_it_can_get_array_using_get_method()
	{
		$array = $this->collection->get();

		$this->assertTrue(is_array($array));
		$this->assertEquals(2, count($array));
	}

	public function test_it_can_get_using_get_method()
	{
		$this->assertEquals('value', $this->collection->get('key'));
		$this->assertEquals('dev', $this->collection->get('foo'));

		$this->assertNull($this->collection->get('else'));
	}

	public function test_it_can_get_by_index_using_get_method()
	{
		$this->assertEquals('value', $this->collection->get(0));
		$this->assertEquals('dev', $this->collection->get(1));

		$this->assertNull($this->collection->get(1000));
	}

	public function test_it_can_return_default_value_if_key_not_found()
	{
		$this->assertEquals('value', $this->collection->get('key', 'Default'));

		$this->assertEquals('Default', $this->collection->get('empty', 'Default'));
	}

	public function test_iteration_works_properly()
	{
		$this->collection->each(fn ($key, $value) => $this->assertEquals($value, $this->collection->get($key)));
	}

	public function test_it_can_map_items()
	{
		$nums = arr([1, 2, 3, 4])->map(fn ($item) => $item * 10)->get();
		$this->assertEquals([10, 20, 30, 40], $nums);
	}

	public function test_it_can_push_item()
	{
		$this->collection->add('Hello', 'World');
		$this->assertEquals('World', $this->collection->get('Hello'));

		$nums = arr([1, 2, 3, 4])->add(5);
		$this->assertEquals([1, 2, 3, 4, 5], $nums->get());
	}

	public function test_it_can_remove_item()
	{
		$this->collection->remove('Hello');
		$this->assertNull($this->collection->get('Hello'));

		$this->collection->remove('else');
		$this->assertNull($this->collection->get('else'));

		$nums = arr([1, 2, 3, 4])->remove(2);
		$this->assertEquals([1, 2, 4], array_values($nums->get()));
	}
}
