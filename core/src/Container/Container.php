<?php

namespace Core\Container;

use Core\Collection\Collection;
use Psr\Container\ContainerInterface;
use ReflectionClass;
use ReflectionType;

class Container implements ContainerInterface
{
	private Collection $singletons;
	private Collection $instances;
	private Collection $bindings;

	public function __construct()
	{
		$this->singletons = arr([]);
		$this->instances = arr([]);
		$this->bindings = arr([]);
	}

	public function get(string $id)
	{
		throwUnless($this->has($id), new ContainerNotFoundException());
		return $this->resolve($id);
	}

	public function has(string $id): bool
	{
		return $this->singletons->exists($id) || $this->bindings->exists($id);
	}

	public function bind(string $interface, $factory): void
	{
		$this->bindings->{$interface} = $factory;
	}

	public function singleton(string $interface, $factory): void
	{
		$this->singletons->{$interface} = $factory;
	}

	public function resolve(string $interface): object|null
	{
		if ($this->singletons->exists($interface)) {
			return $this->resolveFromSingletons($interface);
		}

		if ($this->bindings->exists($interface)) {
			return $this->resolveFromBindings($interface);
		}

		return $this->new($interface);
	}

	public function new(string $interface): object|null
	{
		if (!class_exists($interface)) {
			return null;
		}

		$reflector = new ReflectionClass($interface);

		if (!$reflector->isInstantiable()) {
			return null;
		}

		$constructor = $reflector->getConstructor();

		if (is_null($constructor)) {
			return $reflector->newInstance();
		}

		$params = $this->resolveParameters($constructor->getParameters());
		return $reflector->newInstanceArgs($params);
	}

	private function resolveFromBindings(string $interface): object
	{
		return $this->handleResolution($this->bindings->{$interface});
	}

	private function resolveFromSingletons(string $interface): object
	{
		if (!$this->instances->exists($interface)) {
			$this->instances->{$interface} = $this->handleResolution($this->singletons->{$interface});
		}
		return $this->instances->{$interface};
	}

	private function handleResolution($factory): object
	{
		if (is_callable($factory)) {
			return call_user_func($factory);
		}

		return $this->new($factory);
	}

	private function resolveParameters(array $parameters): array
	{
		$dependencies = [];
		foreach ($parameters as $parameter) {
			$dependency = $parameter->getType();
			if ($this->canResolveType($dependency)) {
				$dependencies[] = $this->resolve("$dependency");
			} else {
				$dependencies[] = $parameter->isDefaultValueAvailable() ? $parameter->getDefaultValue() : $this->generateParameterDefaultValue($dependency);
			}
		}
		return $dependencies;
	}

	private function generateParameterDefaultValue(?ReflectionType $type): mixed
	{
		$default = null;
		if (!is_null($type)) {
			if (str_starts_with("$type", '?')) {
				$type = substr("$type", 1, strlen("$type") - 1);
			}
			settype($default, $type);
		}
		return $default;
	}

	private function canResolveType(?ReflectionType $type): bool
	{
		return !is_null($type) && !$type->isBuiltin();
	}
}
