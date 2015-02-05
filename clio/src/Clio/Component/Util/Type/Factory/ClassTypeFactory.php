<?php
namespace Clio\Component\Util\Type\Factory;

class PrimitiveTypeFactory extends AbstractTypeFactory
{
	public function createType($name)
	{
		if(!class_exists($name)) {
			throw new \InvalidArgumentException(sprintf('Class "%s" is not exists.', $name));
		}

		return new ClassType($name);
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
		return class_exists($name);
	}
}

