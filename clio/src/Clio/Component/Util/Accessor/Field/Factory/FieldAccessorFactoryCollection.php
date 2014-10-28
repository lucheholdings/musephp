<?php
namespace Clio\Component\Util\Accessor\Field\Factory;

use Clio\Component\Pattern\Factory\FactoryCollection;
use Clio\Component\Util\Accessor\Field\FieldAccessorFactory;

/**
 * FieldAccessorFactoryCollection 
 * 
 * @uses FactoryCollection
 * @uses FieldAccessorFactory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class FieldAccessorFactoryCollection extends FactoryCollection implements FieldAccessorFactory 
{
	/**
	 * {@inheritdoc}
	 */
	public function createFieldAccessor($schema, $fieldName, array $options = array())
	{
		return $this->createArgs(array($schema, $fieldName, $options));
	}

	public function createFieldAccessorByType($type, $schema, $fieldName, array $options = array())
	{
		return $this->createByKeyArgs($type, array($schema, $fieldName, $options));
	}

	/**
	 * {@inheritdoc}
	 */
	public function isSupportedField($schema, $fieldName, array $options = array())
	{
		return $this->isSupportedFactory(array($shema, $fieldName, $options));
	}

	public function isSupportedFieldType($type, $schema, $filedName, array $options = array())
	{
		if(!$this->has($type)) {
			throw new \Exception(sprintf('Unsupported Type "%s"', $type));
		}
		return $this->get($type)->isSupportedFactory(array($schema, $fieldName, $options));
	}
}

