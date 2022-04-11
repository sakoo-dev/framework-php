<?php

namespace Core\Tests\Utilities;

use Core\Testing\TestCase;
use Core\Utilities\Locker;

class LockerTest extends TestCase
{
	public function test_locker_works_properly()
	{
		$locker = new Locker();
		$this->assertFalse($locker->isLocked());

		$locker->lock();
		$this->assertTrue($locker->isLocked());

		$locker->unlock();
		$this->assertFalse($locker->isLocked());
	}
}
