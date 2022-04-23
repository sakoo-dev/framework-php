<?php

namespace Core\Kernel;

use Core\Container\Container;
use Core\Path\Path;

class Kernel
{
	public float $startTime = 0;
	public Container $container;

	private function __construct(public Environment $environment)
	{
		$this->startTime = microtime(true);
		$this->setGlobalKernel();

		require_once Path::getCoreDir() . '/helpers.php';
		$this->container = new Container();
	}

	public static function run(Environment $environment): self
	{
		return new self($environment);
	}

	private function setGlobalKernel(): void
	{
		global $kernel;
		$kernel = $this;
	}
}
