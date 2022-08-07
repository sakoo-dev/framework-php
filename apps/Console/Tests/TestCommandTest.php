<?php

namespace Apps\Console\Tests;

use System\Testing\TestCase;

class TestCommandTest extends TestCase
{
	public function test_it_loads_test_command_properly()
	{
		$commandTester = $this->getAssistantApplication(['test']);
		$commandTester->assertCommandIsSuccessful();
		$result = $commandTester->getDisplay();

		$this->assertStringContainsString('This is a Test', $result);
	}
}
