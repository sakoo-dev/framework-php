<?php

use Core\Console\Assistant;
use Core\Console\Commands\ZenCommand;

$commands = [];

/** @var Assistant $assistant */
$assistant = resolve(Assistant::class);
$assistant->console->addCommands($commands);
$assistant->console->setDefaultCommand(ZenCommand::getDefaultName());

return $assistant;
