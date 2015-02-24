<?php
namespace Clio\Component\Pattern\Factory;

abstract class AbstractMappedFactory extends AbstractFactory implements MappedFactory
{
	public function createByKey()
	{
		return $this->doCreate(func_get_args());
	}

	public function createByKeyArgs($key, array $args = array())
	{
		array_unshift($args, $key);
		return $this->doCreate($args);
	}

	public function isSupportedKeyArgs($key, array $args = array())
	{
		array_unshift($args, $key);
		return $this->isSupportedArgs($args);
	}
}

