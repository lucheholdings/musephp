<?php
namespace Clio\Component\Util\Type\Factory;

class ClassTypeFactory extends AbstractTypeFactory
{
	public function createType($name)
	{
		if(class_exists($name)) { 
		    return new ClassType($name);
        } else if (interface_exists($name)) {
		    return new InterfaceType($name);
		}

		throw new \InvalidArgumentException(sprintf('Class or Interface "%s" is not exists.', $name));
	}

	public function createTypeForValue($value)
	{
		if(is_object($value)) {
			return $this->createType(get_class($value));
		}

		throw new \InvalidArgumentException('Value is not an object.');
	}

	public function isSupportedType($name)
	{
		return class_exists($name) || interface_exits($name);
	}
}

