<?php

namespace Core\Console\Commands;

use Core\Console\Command;
use Core\Constants;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ZenCommand extends Command
{
	protected static $defaultName = 'zen';
	protected static $defaultDescription = 'Display Zen of the ' . Constants::FRAMEWORK_NAME;

	public function execute(InputInterface $input, OutputInterface $output): int
	{
		$style = new SymfonyStyle($input, $output);

		$style->block([
			"\t\t=======================",
			"\t\t=========",
			' =======================',
		], style: 'fg=cyan');

		$style->text([
			Constants::FRAMEWORK_NAME . ' (Version: ' . Constants::FRAMEWORK_VERSION . ')',
			'Copyright ' . date('Y') . ' by ' . Constants::AUTHOR,
		]);

		$style->newLine();

		return Command::SUCCESS;
	}
}
