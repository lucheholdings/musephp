<?php
namespace Clio\Component\Pce\FieldAccessor\Factory;

use Clio\Component\Pce\Construction\ComponentFactory;

/**
 * AbstractFieldAccessorFactory 
 * 
 * @uses ComponentFactory
 * @abstract
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class AbstractFieldAccessorFactory extends ComponentFactory implements
	FieldAccessorFactory
{
	/**
	 * doCreate 
	 * 
	 * @param mixed $args 
	 * @access protected
	 * @return void
	 */
	protected function doCreate(array $args)
	{
		return call_user_func_array(
			array($this, 'createFieldAccessor'),
			$args
		);
	}
}

