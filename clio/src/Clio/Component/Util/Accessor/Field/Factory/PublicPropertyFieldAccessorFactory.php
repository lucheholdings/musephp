<?php
namespace Clio\Component\Util\Accessor\Field\Factory;

use Clio\Component\Util\Accessor\Field;
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
	public function createFieldAccessor(Field $field, array $options = array())
	{
		$classReflector = $field->getSchema()->getReflectionClass();

		$propertyReflector = $classReflector->getProperty($field->getName());

		return new PublicPropertyFieldAccessor($field->getName(), $propertyReflector);
	}

	/**
	 * {@inheritdoc}
	 */
	public function isSupportedField(Field $field)
	{
		if(($field->getSchema() instanceof ReflectionClassAwarable) && $field->getSchema()->isReflectionClassAwared()) {
			$classReflector = $field->getSchema()->getReflectionClass();

			return ($classReflector->hasProperty($field->getName()) && $classReflector->getProperty($field->getName())->isPublic());
		}

		return false;
	}
}

