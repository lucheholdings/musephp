<?php
namespace Clio\Component\Util\Container\Map;

use Clio\Component\Util\Container\Map;
use Clio\Component\Util\Container\AbstractContainer;

abstract class AbstractMap extends AbstractContainer implements Map
{
	public function offsetGet($key)
	{
		$this->get($key);
	}

	public function offsetSet($key, $value)
	{
		$this->set($key, $value);
	}

	public function offsetUnset($key)
	{
		$this->remove($key);
	}

	public function offsetExists($key)
	{
		$this->hasKey($key);
	}
}

