<?php
namespace Clio\Component\Util\Accessor\Schema\Factory;

use Clio\Component\Pattern\Factory\AbstractFactory;
use Clio\Component\Util\Accessor\Schema\AccessorFactory as SchemaAccessorFactory;
use Clio\Component\Util\Accessor\Field\FieldAccessorFactory;
use Clio\Component\Util\Accessor\Schema;

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
	public function isSupportedArgs(array $args = array())
	{
		return $this->isSupportedSchema(array_shift($args));
	}
}
