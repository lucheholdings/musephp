<?php
namespace Clio\Component\Tool\Schemifier;

class FieldMapperRegistry 
{
	private $mappers;

	public function __construct()
	{
		$this->mappers = array();
	}

	public function has($src, $dest)
	{
		if(!isset($this->mappers[$src]) || !isset($this->mappers[$src][$dest])) {
			return false;
		}

		return true;
	}

	public function get($src, $dest)
	{
		if(!isset($this->mappers[$src]) || !isset($this->mappers[$src][$dest])) {
			throw new \Exception('FieldMapper from "%s" to "%s" is not registered.');
		}

		return $this->mappers[$src][$dest];
	}

	public function set($src, $dest, Mapper $mapper)
	{
		if(!isset($this->mappers[$src])) {
			$this->mappers[$src] = array();
		}

		$this->mappers[$src][$dest] = $mapper;

		return $this;
	}
}

