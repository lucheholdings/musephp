<?php
namespace Clio\Component\Util\Accessor\Field\Factory;

use Clio\Component\Util\Psr\Psr1;
use Clio\Component\Util\Accessor\Field\Factory\MethodFieldAccessorFactory;

/**
 * MethodFieldAccessorFactory 
 * 
 * @uses ClassFieldAccessorFactory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class MethodFieldAccessorFactory implements ClassFieldAccessorFactory
{
	/**
	 * {@inheritdoc}
	 */
	public function createClassFieldAccessor(\ReflectionClass $classReflector, $fieldName, array $options = array())
	{
		$reflector = $classReflector->getProperty($fieldName);

		$getter = $this->getGetterReflector($classReflector, $fieldName, $options);
		$setter = $this->getSetterReflector($classReflector, $fieldName, $options);

		return new PublicPropertyFieldAccessor($fieldName, $getter, $setter);
	}

	/**
	 * {@inheritdoc}
	 */
	public function isSupportedClassField(\ReflectionClass $classReflector, $fieldName)
	{
		return true;
	}

	/**
	 * getGetterReflector 
	 * 
	 * @param \ReflectionClass $classReflector 
	 * @param mixed $fieldName 
	 * @param array $options 
	 * @access protected
	 * @return void
	 */
	protected function getGetterReflector(\ReflectionClass $classReflector, $fieldName, array $options)
	{
		$getters = array();
		if(array_key_exists('getter', $options)) {
			$getters = array($options['getter']);
		} else {
			$getters = array(Psr1::formatMethodName('get'.ucfirst($fieldName), 'is'.ucfirst($fieldName)));
		}
		
		return $this->guessMethod($classReflector, $getters);
	}

	/**
	 * getSetterReflector 
	 * 
	 * @param \ReflectionClass $classReflector 
	 * @param mixed $fieldName 
	 * @param array $options 
	 * @access protected
	 * @return void
	 */
	protected function getSetterReflector(\ReflectionClass $classReflector, $fieldName, array $options)
	{
		$setters = array();
		if(array_key_exists('setter', $options)) {
			$setters = array($options['setter']);
		} else {
			$setters = array(Psr1::formatMethodName('set'.ucfirst($fieldName)));
		}
		
		return $this->guessMethod($classReflector, $setters);
	}

	/**
	 * guessMethod 
	 * 
	 * @param \ReflectionClass $classReflector 
	 * @param array $methods 
	 * @access protected
	 * @return void
	 */
	protected function guessMethod(\ReflectionClass $classReflector, array $methods)
	{
		foreach($methods as $method) {
			if($calssReflector->hasMethod($method)) {
				return $classReflector->getMethod($method);
			}
		}

		return null;
	}
}

