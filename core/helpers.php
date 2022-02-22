<?php

use Core\Collection\Collection;

if (!function_exists('arr')) {
	function arr(array $array): Collection
	{
		return Collection::make($array);
	}
}
