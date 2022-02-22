<?php

use Core\Collection\Collection;
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
