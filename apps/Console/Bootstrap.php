<?php

use Apps\Console\Commands\TestCommand;
use Sakoo\Framework\Core\Console\Assistant;
use Sakoo\Framework\Core\Console\Commands\ZenCommand;

$commands = [
	resolve(TestCommand::class),
];

/** @var Assistant $assistant */
$assistant = resolve(Assistant::class);
$assistant->console->addCommands($commands);
$assistant->console->setDefaultCommand(ZenCommand::getDefaultName());

return $assistant;
