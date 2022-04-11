<?php

namespace Core\Tests\Console\Commands;

use Core\Constants;
use Core\Testing\TestCase;

class ZenCommandTest extends TestCase
{
	public function test_it_loads_zen_command_properly()
	{
		$commandTester = $this->getAssistantApplication(['zen']);
		$commandTester->assertCommandIsSuccessful();
		$result = $commandTester->getDisplay();

		$this->assertStringContainsString(Constants::FRAMEWORK_NAME . ' (Version: ' . Constants::FRAMEWORK_VERSION . ')', $result);
		$this->assertStringContainsString('Copyright ' . date('Y') . ' by ' . Constants::AUTHOR, $result);
	}
}
