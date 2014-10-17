<?php
namespace Clio\Component\Util\Accessor\Field\Factory;

use Clio\Component\Util\Psr\Psr1;
use Clio\Component\Util\Accessor\Field\PublicPropertyFieldAccessor;

/**
 * PublicPropertyFieldAccessorFactory 
 * 
 * @uses ClassFieldAccessorFactory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class PublicPropertyFieldAccessorFactory implements ClassFieldAccessorFactory
{
	/**
	 * {@inheritdoc}
	 */
	public function createClassFieldAccessor(\ReflectionClass $classReflector, $fieldName, array $options = array())
	{
		$reflector = $classReflector->getProperty($fieldName);

		$propertyReflector = $this->getPropertyReflector($classReflector, $fieldName, $options);

		return new PublicPropertyFieldAccessor($fieldName, $propertyReflector);
	}

	/**
	 * {@inheritdoc}
	 */
	public function isSupportedClassField(\ReflectionClass $classReflector, $fieldName)
	{
		if($classReflector->hasProperty($fieldName) && $classReflector->getProperty($fieldName)->isPublic()) {
			return true;
		}

		return false;
	}

	/**
	 * getPropertyReflector 
	 * 
	 * @param \ReflectionClass $classReflector 
	 * @param mixed $fieldName 
	 * @param array $options 
	 * @access protected
	 * @return void
	 */
	protected function getPropertyReflector(\ReflectionClass $classReflector, $fieldName, array $options)
	{
		return $classReflector->getProperty($fieldName);
	}
}

