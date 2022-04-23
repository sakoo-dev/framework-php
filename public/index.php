<?php

use Core\Kernel\Environment;
use Core\Kernel\Kernel;

require_once getcwd() . '/vendor/autoload.php';
Kernel::run(Environment::HTTP);
