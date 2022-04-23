<?php

namespace Core\Path;

use Symfony\Component\Finder\Finder;

class Path
{
	public static function getRootDir(): string
	{
		return getcwd();
	}

	public static function getCoreDir(): string
	{
		return static::getRootDir() . '/core';
	}

	public static function getAppsDir(): string
	{
		return static::getRootDir() . '/apps';
	}

	public static function getVendorDir(): string
	{
		return static::getRootDir() . '/vendor';
	}

	public static function getStorageDir(): string
	{
		return static::getRootDir() . '/storage';
	}

	public static function getProjectPHPFiles(): Finder
	{
		return Finder::create()
			->name(['*.php'])
			->ignoreVCS(true)
			->ignoreVCSIgnored(true)
			->ignoreDotFiles(true)
			->in(static::getRootDir());
	}
}
