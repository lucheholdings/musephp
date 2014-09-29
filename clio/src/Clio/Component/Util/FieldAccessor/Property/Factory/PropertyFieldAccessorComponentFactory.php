<?php
namespace Clio\Component\Util\FieldAccessor\Property\Factory;

use Clio\Component\Util\ComponentFactory;
use Clio\Component\Util\FieldAccessor\Mapping\ClassMapping;

/**
 * FieldAccessorComponentFactory 
 * 
 * @uses ComponentFactory
 * @uses FieldAccessorFactory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class PropertyFieldAccessorComponentFactory extends ComponentFactory implements PropertyFieldAccessorFactory
{
	/**
	 * createFieldAccessor 
	 * 
	 * @param mixed $classMapping 
	 * @param mixed $field 
	 * @access public
	 * @return void
	 */
	public function createPropertyFieldAccessor(ClassMapping $classMapping, $field)
	{
		return $this->create($classMapping, $field);
	}
}

