<?php

namespace Core\Tests\Testing;

use Core\Testing\TestCase;

class TestCaseTest extends TestCase
{
	/** @test */
	public function itCanRunPhpUnit()
	{
		$this->assertTrue(true);
	}
}
