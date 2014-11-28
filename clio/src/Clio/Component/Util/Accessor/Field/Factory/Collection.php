<?php
namespace Clio\Component\Util\Accessor\Field\Factory;

use Clio\Component\Pattern\Factory\NamedCollection as NamedFactoryCollection;
use Clio\Component\Util\Accessor\Field\FieldAccessorFactory;

use Clio\Component\Util\Accessor\Field;
use Clio\Component\Util\Accessor\Schema;
use Clio\Component\Exception\UnsupportedException;

/**
 * Collection 
 * 
 * @uses NamedCollection
 * @uses FieldAccessorFactory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class Collection extends NamedFactoryCollection implements FieldAccessorFactory 
{
	/**
	 * {@inheritdoc}
	 */
	public function createFieldAccessorWithoutType(Field $field, array $options = array())
	{
		return $this->createByKeyArgs($this->guessFieldType($field), array($field, $options));
	}

	/**
	 * {@inheritdoc}
	 */
	public function createFieldAccessorByType($type, Field $field, array $options = array())
	{
		return $this->createByKeyArgs($type, array($field, $options));
	}

	public function isSupportedFieldType($type, Field $field, array $options = array())
	{
		if(!$this->has($type)) {
			throw new \Exception(sprintf('Unsupported Type "%s"', $type));
		}
		return $this->get($type)->isSupportedArgs(array($field, $options));
	}

	protected function guessFieldType(Field $field)
	{
		if($field->getSchema() instanceof Schema\ClassSchema) {
			$classReflector = $field->getSchema()->getReflectionClass();
			if($classReflector->hasProperty($field->getName()) && $classReflector->getProperty($field->getName())->isPublic()) {
				return 'public_property';
			} else {
				return 'method';
			}
		} else if($field->getSchema() instanceof Schema\ArraySchema) {
			return 'array_field';
		}

		throw new UnsupportedException('Failed to guess the field type.');
	}

	/**
	 * {@inheritdoc}
	 */
	public function createFieldAccessor(Field $field, array $options = array())
	{
		foreach($this as $factory) {
			if($factory->isSupportedField($field)) {
				return $factory->createFieldAccessor($field, $options);
			}
		}

		throw new \RuntimeException('Unsupported');
	}

	/**
	 * {@inheritdoc}
	 */
	public function isSupportedField(Field $field)
	{
		foreach($this as $factory) {
			if($factory->isSupportedField($field)) {
				return true;
			}
		}
		return false;
	}
}

