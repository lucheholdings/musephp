<?php
namespace Clio\Component\Util\Accessor\Field\Factory;

use Clio\Component\Util\Psr\Psr1;
use Clio\Component\Util\Accessor\Field\PublicPropertyFieldAccessor;

/**
 * PublicPropertyFieldAccessorFactory 
 * 
 * @uses FieldAccessorFactory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class PublicPropertyFieldAccessorFactory extends AbstractFieldAccessorFactory 
{
	/**
	 * {@inheritdoc}
	 */
	public function createFieldAccessor($schema, $fieldName, array $options = array())
	{
		$reflector = $schema->getProperty($fieldName);

		$propertyReflector = $this->getPropertyReflector($schema, $fieldName, $options);

		return new PublicPropertyFieldAccessor($fieldName, $propertyReflector);
	}

	/**
	 * {@inheritdoc}
	 */
	public function isSupportedField($schema, $fieldName)
	{
		if(($schema instanceof \ReflectionClass) && $schema->hasProperty($fieldName) && $schema->getProperty($fieldName)->isPublic()) {
			return true;
		}

		return false;
	}

	/**
	 * getPropertyReflector 
	 * 
	 * @param \ReflectionClass $schema 
	 * @param mixed $fieldName 
	 * @param array $options 
	 * @access protected
	 * @return void
	 */
	protected function getPropertyReflector(\ReflectionClass $schema, $fieldName, array $options)
	{
		return $schema->getProperty($fieldName);
	}
}

