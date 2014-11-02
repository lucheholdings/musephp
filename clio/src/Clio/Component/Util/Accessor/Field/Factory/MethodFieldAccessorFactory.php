<?php
namespace Clio\Component\Util\Accessor\Field\Factory;

use Clio\Component\Util\Accessor\Field;
use Clio\Component\Util\Psr\Psr1;
use Clio\Component\Util\Accessor\Field\MethodFieldAccessor;

/**
 * MethodFieldAccessorFactory 
 * 
 * @uses FieldAccessorFactory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class MethodFieldAccessorFactory extends AbstractFieldAccessorFactory
{
	/**
	 * {@inheritdoc}
	 */
	public function createFieldAccessor(Field $field, array $options = array())
	{
		$getter = $this->getGetterReflector($field->getSchema()->getReflectionClass(), $field->getName(), $options);
		$setter = $this->getSetterReflector($field->getSchema()->getReflectionClass(), $field->getName(), $options);

		if(!$getter && !$setter) {
			throw new \InvalidArgumentException(sprintf('Class "%s" does not have getter and setter.', $field->getSchema()->getName()));
		}

		return new MethodFieldAccessor($field->getName(), $getter, $setter);
	}

	/**
	 * {@inheritdoc}
	 */
	public function isSupportedField(Field $field)
	{
		return ($field->getSchema() instanceof \ReflectionClass);
	}

	/**
	 * getGetterReflector 
	 * 
	 * @param \ReflectionClass $schema 
	 * @param mixed $fieldName 
	 * @param array $options 
	 * @access protected
	 * @return void
	 */
	protected function getGetterReflector(\ReflectionClass $schema, $fieldName, array $options)
	{
		$getters = array();
		if(array_key_exists('getter', $options)) {
			$getters = array($options['getter']);
		} else {
			$getters = array(Psr1::formatMethodName('get'.ucfirst($fieldName), 'is'.ucfirst($fieldName)));
		}
		
		return $this->guessMethod($schema, $getters);
	}

	/**
	 * getSetterReflector 
	 * 
	 * @param \ReflectionClass $schema 
	 * @param mixed $fieldName 
	 * @param array $options 
	 * @access protected
	 * @return void
	 */
	protected function getSetterReflector(\ReflectionClass $schema, $fieldName, array $options)
	{
		$setters = array();
		if(array_key_exists('setter', $options)) {
			$setters = array($options['setter']);
		} else {
			$setters = array(Psr1::formatMethodName('set'.ucfirst($fieldName)));
		}
		
		return $this->guessMethod($schema, $setters);
	}

	/**
	 * guessMethod 
	 * 
	 * @param \ReflectionClass $schema 
	 * @param array $methods 
	 * @access protected
	 * @return void
	 */
	protected function guessMethod(\ReflectionClass $schema, array $methods)
	{
		foreach($methods as $method) {
			if($schema->hasMethod($method)) {
				return $schema->getMethod($method);
			}
		}

		return null;
	}
}

