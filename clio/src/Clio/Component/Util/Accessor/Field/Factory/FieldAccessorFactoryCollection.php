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
		return $this->doCreate(array($schema, $fieldName, $options));
	}

	/**
	 * {@inheritdoc}
	 */
	public function isSupportedSchemaField($schema, $fieldName)
	{
		return $this->isSupportedFactory(array($shema, $fieldName));
	}
}

