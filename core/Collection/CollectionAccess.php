<?php

namespace Core\Collection;

trait CollectionAccess
{
	public function first(): mixed
	{
		return $this->get(0);
	}

	public function second(): mixed
	{
		return $this->get(1);
	}

	public function third(): mixed
	{
		return $this->get(2);
	}

	public function fourth(): mixed
	{
		return $this->get(3);
	}

	public function fifth(): mixed
	{
		return $this->get(4);
	}

	public function sixth(): mixed
	{
		return $this->get(5);
	}

	public function seventh(): mixed
	{
		return $this->get(6);
	}

	public function eighth(): mixed
	{
		return $this->get(7);
	}

	public function ninth(): mixed
	{
		return $this->get(8);
	}

	public function tenth(): mixed
	{
		return $this->get(9);
	}
}
