<?php

namespace Core\Console\Commands;

use Core\Console\Command;
use Core\Path\Path;
use Core\Watcher\Watcher;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class WatchCommand extends Command
{
	protected static $defaultName = 'watch';
	protected static $defaultDescription = 'Run file Watcher';

	public function execute(InputInterface $input, OutputInterface $output): int
	{
		/** @var Watcher $watcher */
		$watcher = resolve(Watcher::class);

		$style = new SymfonyStyle($input, $output);

		$style->block('Watching ...', style: 'fg=cyan');

		$watcher->watch(Path::getProjectPHPFiles(), function ($event, &$locker) use ($style) {
			$style->block($event['name'] . ' in ' . date('H:i:s'), style: 'fg=green');
			$this->makeStyleFix($event['name']);
			$locker->unlock();
			$style->block('Watching ...', style: 'fg=cyan');
		})->run();

		return Command::SUCCESS;
	}

	private function makeStyleFix($path): void
	{
		$vendor = Path::getVendorDir();
		exec("php $vendor/bin/php-cs-fixer fix $path");
	}
}
