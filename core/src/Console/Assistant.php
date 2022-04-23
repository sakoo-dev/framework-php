<?php

namespace Core\Console;

use Core\Constants;
use Core\Path\Path;
use Symfony\Component\Console\Application;
use Symfony\Component\Finder\Finder;

class Assistant
{
	public function __construct(public Application $console, private Finder $commandFinder)
	{
		$console->setName(Constants::FRAMEWORK_NAME);
		$console->setVersion(Constants::FRAMEWORK_VERSION);
		$commandFinder = $commandFinder->files()->in($this->getDefaultCommandsDir());
		$this->loadDefaultCommands($commandFinder);
	}

	private function loadDefaultCommands(Finder $finder)
	{
		foreach ($finder as $file) {
			$class = $this->getDefaultCommandsNamespace() . $file->getFilenameWithoutExtension();
			$this->console->add(resolve($class));
		}
	}

	private function getDefaultCommandsDir(): string
	{
		return Path::getCoreDir() . '/src/Console/Commands';
	}

	private function getDefaultCommandsNamespace(): string
	{
		return 'Core\\Console\\Commands\\';
	}
}
