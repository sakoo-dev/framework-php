<?php

use Core\Kernel\Environment;
use Core\Kernel\Kernel;

require_once __DIR__ . '/../vendor/autoload.php';
Kernel::run(Environment::HTTP);
