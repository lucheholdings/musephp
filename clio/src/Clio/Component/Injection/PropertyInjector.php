<?php
namespace Clio\Component\Injection;

class PropertyInjector extends AbstractInjector 
{
	public function __construct($propertyName, $value)
	{
		$this->propertyName = $propertyName;
		$this->value = $value;
	}

	protected function doInject($refObject, $object)
	{
		if(!$refObject->hasProperty($this->propertyName)) {
			throw new InjectionException(sprintf('Property "%s::%s" dose not exist.', $refObject->getName(), $this->propertyName));
		}

		$refProperty = $reflectionObject->getProperty($this->propertyName);

		if(!$refProperty->isPublic()) {
			throw new InjectionException('Property "%s::%s" is not a public method.', $refObject->getName(), $refProperty->getName());
		}

		//
		$refProperty->setValue($object, $this->value);
	}
}

