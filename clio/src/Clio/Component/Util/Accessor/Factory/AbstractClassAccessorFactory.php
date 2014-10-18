<?php
namespace Clio\Component\Util\Accessor\Factory;

/**
 * AbstractClassAccessorFactory 
 * 
 * @uses AbstractSchemaAccessorFactory
 * @abstract
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class AbstractClassAccessorFactory extends AbstractSchemaAccessorFactory
{
	/**
	 * {@inheritdoc}
	 */
	public function createSchemaAccessor($schema, array $options = array())
	{
		return $this->createClassAccessor($schema, $options);
	}

	/**
	 * {@inheritdoc}
	 */
	protected function isSupportedSchema($schema)
	{
		return $this->isSupportedClassSchema($schema);
	}

	/**
	 * isSupportedClassSchema 
	 * 
	 * @param mixed $schema 
	 * @abstract
	 * @access protected
	 * @return void
	 */
	abstract protected function isSupportedClassSchema($schema);

}

