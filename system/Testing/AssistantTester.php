<?php

namespace System\Testing;

use Sakoo\Framework\Core\Console\Assistant;
use Sakoo\Framework\Core\Testing\Traits\AssistantTester as ParentAssistantTester;
use System\Path\Path;

trait AssistantTester
{
	use ParentAssistantTester {
		ParentAssistantTester::getAssistantApp as parentGetAssistantApp;
	}

	public function getAssistantApp(): Assistant
	{
		return require_once Path::getAppsDir() . '/Console/Bootstrap.php';
	}
}
