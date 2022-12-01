<?php

namespace System\Path;

use Sakoo\Framework\Core\Path\Path as CorePath;

class Path extends CorePath
{
	public static function getAppsDir(): string
	{
		return static::getRootDir() . '/apps';
	}

	public static function getSystemDir(): string
	{
		return static::getRootDir() . '/system';
	}
}
