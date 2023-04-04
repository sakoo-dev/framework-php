<?php

namespace Apps\Console\Commands;

use Sakoo\Framework\Core\Console\Command;
use Sakoo\Framework\Core\Console\Commands\WatchCommand as CoreWatchCommand;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand('watch', 'Run file Watcher')]
class WatchCommand extends CoreWatchCommand
{
	public function execute(InputInterface $input, OutputInterface $output): int
	{
		// for customizing this command, comment below line and write your logic from scratch
		parent::execute($input, $output);
		return Command::SUCCESS;
	}
}
