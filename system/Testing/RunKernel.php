<?php

namespace System\Testing;

use Sakoo\Framework\Core\Env\Env;
use Sakoo\Framework\Core\Kernel\Environment;
use Sakoo\Framework\Core\Kernel\Kernel;
use Sakoo\Framework\Core\Kernel\Mode;
use System\Handler\ErrorHandler;
use System\Handler\ExceptionHandler;
use System\Path\Path;

trait RunKernel
{
	public static function runKernel(): void
	{
		Env::load(Path::getRootDir() . '/.env');

		$loaders = require_once Path::getSystemDir() . '/ServiceLoader/Loaders.php';
		$timeZone = Env::get('SERVER_TIME_ZONE', 'Asia/Tehran');

		Kernel::prepare(Mode::Test, Environment::Production)
			->setErrorHandler(new ErrorHandler())
			->setExceptionHandler(new ExceptionHandler())
			->setServiceLoaders($loaders)
			->setServerTimezone($timeZone)
			->run();
	}
}
