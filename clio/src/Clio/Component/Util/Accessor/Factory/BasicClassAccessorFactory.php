<?php
namespace Clio\Component\Util\Accessor\Factory;

use Clio\Component\Pattern\Factory\AbstractFactory;
use Clio\Component\Util\Accessor\Field\Factory\ClassFieldAccessorFactory;
use Clio\Component\Util\Accessor\Field\Factory\FieldAccessorFactoryCollection;
use Clio\Component\Util\Accessor\Field\Factory\PublicPropertyFieldAccessorFactory,
	Clio\Component\Util\Accessor\Field\Factory\MethodFieldAccessorFactory
;
use Clio\Component\Util\Accessor\SimpleClassAccessor;

/**
 * BasicClassAccessorFactory 
 * 
 * @uses ComponentFactory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class BasicClassAccessorFactory extends AbstractClassAccessorFactory
{
	static public function createDefaultFactory()
	{
		return new static(new FieldAccessorFactoryCollection(array(
			new PublicPropertyFieldAccessorFactory(),
			new MethodFieldAccessorFactory(),
		)));
	}

	/**
	 * createClassAccessor 
	 * 
	 * @param mixed $class 
	 * @access public
	 * @return void
	 */
	public function createClassAccessor($class, array $options = array())
	{
		if($class instanceof \ReflectionClass) {
			$classReflector = $class;
		} else if(is_object($class)) {
			$classReflector = new \ReflectionClass($class);
		} else if(is_string($class) && class_exists($class)) {
			$classReflector = new \ReflectionClass($class);
		} else {
			throw new \InvalidArgumentException(sprintf('createClassAccessor only accept a ReflectionClass or an instance, but %s is given.', gettype($class)));
		}

		$fields = $this->createFieldAccessors($classReflector, array_map(function($property){
				return $property->getName();
			}, $classReflector->getProperties()));
		return new SimpleClassAccessor($classReflector, $fields, $options);
	}

	/**
	 * {@inheritdoc}
	 */
	public function isSupportedClassSchema($class)
	{
		return is_object($class) || (is_string($class) && class_exists($class));
	}
}

