<?php

namespace Core\Tests\Container;

use Core\Collection\Collection;
use Core\Testing\TestCase;

class CollectionAccessTest extends TestCase
{
	private Collection $numbers;

	protected function setUp(): void
	{
		parent::setUp();
		$this->numbers = arr([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);
	}

	public function test_it_can_get_first_collection_item()
	{
		$this->assertEquals(1, $this->numbers->first());
	}

	public function test_it_can_get_second_collection_item()
	{
		$this->assertEquals(2, $this->numbers->second());
	}

	public function test_it_can_get_third_collection_item()
	{
		$this->assertEquals(3, $this->numbers->third());
	}

	public function test_it_can_get_fourth_collection_item()
	{
		$this->assertEquals(4, $this->numbers->fourth());
	}

	public function test_it_can_get_fifth_collection_item()
	{
		$this->assertEquals(5, $this->numbers->fifth());
	}

	public function test_it_can_get_sixth_collection_item()
	{
		$this->assertEquals(6, $this->numbers->sixth());
	}

	public function test_it_can_get_seventh_collection_item()
	{
		$this->assertEquals(7, $this->numbers->seventh());
	}

	public function test_it_can_get_eighth_collection_item()
	{
		$this->assertEquals(8, $this->numbers->eighth());
	}

	public function test_it_can_get_ninth_collection_item()
	{
		$this->assertEquals(9, $this->numbers->ninth());
	}

	public function test_it_can_get_tenth_collection_item()
	{
		$this->assertEquals(10, $this->numbers->tenth());
	}
}
