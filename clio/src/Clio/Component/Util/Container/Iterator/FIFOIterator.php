<?php
namespace Clio\Component\Util\Container\Iterator;

class FIFOIterator implements \Iterator 
{
	public function __construct(SequencialAccessable $storage)
	{
		$this->storage = $storage;
	}

	public function key()
	{
		return $this->position;
	}

	public function current()
	{

	}

	public function key()
	{

	}

	public function next()
	{

	}

	public function rewind()
	{
		$this->position = 
	}

	public function valid()
	{

	}
}
