<?php
namespace Melete;

class Content extends \StdClass 
{
	public function __construct(array $values = array())
	{
		foreach($values as $key => $value) {
			$this->{$key} = $value;
		}
	}

	public function get($key)
	{
		return $this->{$key};
	}

	public function set($key, $value)
	{
		$this->{$key} = $value;
		return $this;
	}

	public function has($key)
	{
		return isset($this->{$key});
	}
}

