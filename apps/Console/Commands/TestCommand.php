<?php

namespace Apps\Console\Commands;

use Sakoo\Framework\Core\Console\Command;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand('test', 'Prints a test Command')]
class TestCommand extends Command
{
	public function execute(InputInterface $input, OutputInterface $output): int
	{
		$style = new SymfonyStyle($input, $output);

		$style->text('This is a Test');
		$style->newLine();

		return Command::SUCCESS;
	}
}
