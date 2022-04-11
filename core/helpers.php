<?php

use Core\Collection\Collection;
use Core\Container\Container;
use Core\Kernel\Kernel;

if (!function_exists('arr')) {
	function arr(array $array): Collection
	{
		return Collection::make($array);
	}
}

if (!function_exists('kernel')) {
	function kernel(): Kernel
	{
		global $kernel;
		return $kernel;
	}
}

if (!function_exists('container')) {
	function container(): Container
	{
		return kernel()->container;
	}
}

if (!function_exists('bind')) {
	function bind($interface, $object): void
	{
		container()->bind($interface, $object);
	}
}

if (!function_exists('singleton')) {
	function singleton($interface, $object): void
	{
		container()->singleton($interface, $object);
	}
}

if (!function_exists('resolve')) {
	function resolve($interface): mixed
	{
		return container()->resolve($interface);
	}
}

if (!function_exists('getNew')) {
	function getNew($interface): object
	{
		return container()->new($interface);
	}
}

if (!function_exists('throwIf')) {
	function throwIf($condition, $exception)
	{
		if (!$condition) {
			return;
		}

		if (is_object($exception)) {
			throw $exception;
		}

		throw resolve($exception);
	}
}

if (!function_exists('throwUnless')) {
	function throwUnless($condition, $exception)
	{
		throwIf(!$condition, $exception);
	}
}
