<?php
namespace Clio\Component\Util\Accessor\Field\Factory;

/**
 * AbstractClassFieldAccessorFactory 
 * 
 * @uses AbstractFactory
 * @uses ClassFieldAccessorFactory
 * @abstract
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class AbstractClassFieldAccessorFactory extends AbstractFieldAccessorFactory implements ClassFieldAccessorFactory
{
	/**
	 * {@inheritdoc}
	 */
	public function createFieldAccessor($schema, $field, array $options = array())
	{
		return $this->createClassFieldAccessor($schema, $field, $options);
	}

	/**
	 * {@inheritdoc}
	 */
	public function isSupportedSchemaField($schema, $field)
	{
		return $this->isSupportedClassField($schema, $field);
	}
}

