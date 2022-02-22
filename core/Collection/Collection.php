<?php

namespace Core\Collection;

class Collection
{
	use CollectionAccess;

	private array $data = [];

	private function __construct()
	{
	}

	public static function make(array $array)
	{
		$object = new self();
		$object->data = $array;
		return $object;
	}

	public function __get(string $name): mixed
	{
		return $this->exists($name) ? $this->data[$name] : null;
	}

	public function __set(string $name, $value): void
	{
		$this->data[$name] = $value;
	}

	public function exists($name): bool
	{
		return isset($this->data[$name]);
	}

	public function count(): int
	{
		return count($this->data);
	}

	public function each($callback): void
	{
		foreach ($this->data as $key => $value) {
			$callback($key, $value);
		}
	}

	public function map($callback): Collection
	{
		return Collection::make(array_map($callback, $this->data));
	}

	public function add($key, $value = null): self
	{
		if (is_null($value)) {
			$this->data[] = $key;
			return $this;
		}

		$this->data[$key] = $value;
		return $this;
	}

	public function remove($key): self
	{
		if (is_int($key)) {
			unset($this->data[array_keys($this->data)[$key]]);
			return $this;
		}

		if ($this->exists($key)) {
			unset($this->data[$key]);
		}
		return $this;
	}

	public function get($key = null, $default = null): mixed
	{
		if (is_null($key)) {
			return $this->data;
		}

		if (is_int($key)) {
			$indexValue = current(array_slice($this->data, $key, 1));
			return $indexValue ?: null;
		}

		return isset($this->data[$key]) ? $this->data[$key] : $default;
	}
}
