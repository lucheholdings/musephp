<?php
namespace Clio\Component\Util\Accessor\Field\Factory;

use Clio\Component\Pattern\Factory\AbstractFactory;
use Clio\Component\Util\Accessor\Field\FieldAccessorFactory;

/**
 * AbstractFieldAccessorFactory 
 * 
 * @uses AbstractFactory
 * @uses FieldAccessorFactory
 * @abstract
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class AbstractFieldAccessorFactory extends AbstractFactory implements FieldAccessorFactory
{
	/**
	 * {@inheritdoc}
	 */
	protected function doCreate(array $args)
	{
		$schema = array_shift($args);
		$field = array_shift($args);
		$options = array_shift($args) ?: array();

		return $this->createFieldAccessor($schema, $field, $options);
	}

	/**
	 * {@inheritdoc}
	 */
	public function isSupportedArgs(array $args = array())
	{
		$schema = array_shift($args);
		$field = array_shift($args);

		return $this->isSupportedField($schema, $field);
	}
}

