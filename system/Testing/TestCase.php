<?php

namespace System\Testing;

use Sakoo\Framework\Core\Testing\TestCase as CoreTestCase;

class TestCase extends CoreTestCase
{
	use AssistantTester;
	use RunKernel;
}
