<?php

use Sakoo\Framework\Core\Kernel\Environment;
use Sakoo\Framework\Core\Kernel\Kernel;

require_once getcwd() . '/vendor/autoload.php';
Kernel::run(Environment::HTTP);
