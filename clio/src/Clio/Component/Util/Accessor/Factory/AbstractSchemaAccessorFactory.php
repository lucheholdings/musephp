<?php
namespace Clio\Component\Util\Accessor\Factory;

use Clio\Component\Pattern\Factory\AbstractFactory;
use Clio\Component\Util\Accessor\SchemaAccessorFactory;
use Clio\Component\Util\Accessor\Field\FieldAccessorFactory;

/**
 * AbstractSchemaAccessorFactory 
 * 
 * @uses AccessorFactory
 * @abstract
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class AbstractSchemaAccessorFactory extends AbstractFactory implements SchemaAccessorFactory
{
	/**
	 * {@inheritdoc}
	 */
	public function doCreate(array $args)
	{
		$schema = array_shift($args);
		$options = array_shift($args) ?: array();
		return $this->createSchemaAccessor($schema, $options);
	}
	/**
	 * {@inheritdoc}
	 */
	public function isSupportedFactory(array $args = array())
	{
		return $this->isSupportedSchema(array_shift($args));
	}
}
