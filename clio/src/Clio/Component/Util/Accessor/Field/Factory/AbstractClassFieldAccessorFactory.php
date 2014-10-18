<?php
namespace Clio\Component\Util\Accessor\Field\Factory;
use Clio\Component\Pattern\Factory\AbstractFactory;

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
abstract class AbstractClassFieldAccessorFactory extends AbstractFactory implements ClassFieldAccessorFactory
{
	/**
	 * doCreate 
	 * 
	 * @param array $args 
	 * @access protected
	 * @return void
	 */
	protected function doCreate(array $args)
	{
		$classReflector = array_shift($args);
		$fieldName = array_shift($args);
		$options = array_shift($args) ?: array();

		return $this->createClassFieldAccessor($classReflector, $fieldName, $options);
	}

	/**
	 * isFactoryCreated 
	 * 
	 * @param array $args 
	 * @access public
	 * @return void
	 */
	public function isSupportedFactory(array $args = array())
	{
		$classReflector = array_shift($args);
		$fieldName = array_shift($args);

		return $this->isSupportedClassField($classReflector, $fieldName);
	}
}

