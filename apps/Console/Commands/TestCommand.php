<?php

namespace Apps\Console\Commands;

use Sakoo\Framework\Core\Console\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class TestCommand extends Command
{
	protected static $defaultName = 'test';
	protected static $defaultDescription = 'Print a Test string';

	public function execute(InputInterface $input, OutputInterface $output): int
	{
		$style = new SymfonyStyle($input, $output);

		$style->text('This is a Test');
		$style->newLine();

		return Command::SUCCESS;
	}
}
