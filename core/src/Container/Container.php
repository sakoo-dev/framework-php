<?php

namespace Core\Container;

use Core\Collection\Collection;

class Container
{
	private Collection $singletons;
	private Collection $bindings;

	public function __construct()
	{
		$this->singletons = arr([]);
		$this->bindings = arr([]);
	}

	public function bind($interface, $object): void
	{
		$this->bindings->{$interface} = $object;
	}

	public function singleton($interface, $object): void
	{
		if (is_callable($object)) {
			$this->singletons->{$interface} = $object();
			return;
		}

		if (is_string($object)) {
			$this->singletons->{$interface} = new $object();
			return;
		}

		$this->singletons->{$interface} = $object;
	}

	public function resolve($interface): mixed
	{
		if ($this->singletons->exists($interface)) {
			return $this->singletons->{$interface};
		}

		if ($this->bindings->exists($interface)) {
			if (is_callable($this->bindings->{$interface})) {
				return ($this->bindings->{$interface})();
			}

			if (is_string($interface)) {
				return new ($this->bindings->{$interface})();
			}

			return $this->bindings->{$interface};
		}

		if (class_exists($interface)) {
			return new $interface();
		}

		return null;
	}
}
