<?php

use Core\Kernel\Environment;
use Core\Kernel\Kernel;
use Core\Path\Path;

require_once getcwd() . '/vendor/autoload.php';
Kernel::run(Environment::Console);

/** @var Assistant $assistant */
$assistant = require_once Path::getAppsDir() . '/Console/Bootstrap.php';
$assistant->console->run();
