<?php

use Core\Kernel\Environment;
use Core\Kernel\Kernel;

require_once __DIR__ . '/../../vendor/autoload.php';
Kernel::run(Environment::Console);

/** @var Assistant $assistant */
$assistant = require_once __DIR__ . '/Bootstrap.php';
$assistant->console->run();
