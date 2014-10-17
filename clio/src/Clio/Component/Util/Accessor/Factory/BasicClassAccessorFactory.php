<?php
namespace Clio\Component\Util\Accessor\Factory;

class BasicClassAccessorFactory extends ComponentFactory 
{
	public function __construct()
	{
		parent::__construct('Clio\Component\Util\Accessor\ClassAccessor');

		$this->fieldAccessorFactory = new FieldAccessorFactoryCollection(array(
			new PublicPropertyFieldAccessorFactory(),
			new MethodFieldAccessorFactory(),
		));
	}

	protected function doCreate(array $args = array())
	{
		$class = array_shift($args);
		return $this->createClassAccessor($class);
	}

	public function createClassAccessor($class)
	{
		if($class instanceof \ReflectionClass) {
			$classReflector = $class;
		} else if(is_object($class)) {
			$classReflector = new \ReflectionClass($class);
		} else {
			throw new \InvalidArgumentException(sprintf('createClassAccessor only accept a ReflectionClass or an instance, but %s is given.', gettype($class)));
		}

		$fields = $this->createFieldAccessors($classReflector);
		return new ClassAccessor($classReflector, $fields);
	}

	public function createFieldAccessors(\ReflectionClass $classReflector)
	{
		foreach($classReflector->getProperties() as $property) {
			$this->getFieldAccessorFactory()->createFieldAccessor($property);
		}
	}
}

