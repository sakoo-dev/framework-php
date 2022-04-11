<?php

namespace Core\Tests\Console;

use Core\Constants;
use Core\Testing\TestCase;

class AssistantTest extends TestCase
{
	public function test_it_loads_console_properly()
	{
		$appTester = $this->getAssistantApplication(['--version']);
		$appTester->assertCommandIsSuccessful();

		$result = $appTester->getDisplay();
		$this->assertStringContainsString(Constants::FRAMEWORK_NAME . ' ' . Constants::FRAMEWORK_VERSION, $result);
	}

	public function test_it_loads_default_command_properly()
	{
		$appTester = $this->getAssistantApplication();
		$appTester->assertCommandIsSuccessful();

		$result = $appTester->getDisplay();
		$this->assertStringContainsString(Constants::FRAMEWORK_NAME . ' (Version: ' . Constants::FRAMEWORK_VERSION . ')', $result);
		$this->assertStringContainsString('Copyright ' . date('Y') . ' by ' . Constants::AUTHOR, $result);
	}
}
