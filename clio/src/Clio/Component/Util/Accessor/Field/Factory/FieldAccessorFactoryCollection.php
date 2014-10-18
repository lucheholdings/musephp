<?php
namespace Clio\Component\Util\Accessor\Field\Factory;

use Clio\Component\Pattern\Factory\FactoryCollection;

class FieldAccessorFactoryCollection extends FactoryCollection implements ClassFieldAccessorFactory 
{
	public function createClassFieldAccessor(\ReflectionClass $classReflector, $fieldName)
	{
		return $this->doCreate(array($classReflector, $fieldName));
	}

	public function isSupportedClassField(\ReflectionClass $classReflector, $fieldName)
	{
		return $this->isSupportedFactory(array($classReflector, $fieldName));
	}
}

