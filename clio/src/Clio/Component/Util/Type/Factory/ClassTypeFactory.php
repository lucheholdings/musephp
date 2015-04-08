<?php
namespace Clio\Component\Util\Type\Factory;

use Clio\Component\Util\Type\Actual as ActualTypes;

/**
 * ClassTypeFactory 
 * 
 * @uses AbstractTypeFactory
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class ClassTypeFactory extends AbstractTypeFactory
{
    /**
     * createType 
     * 
     * @param mixed $name 
     * @access public
     * @return void
     */
	public function createType($name)
	{
		if(class_exists($name)) { 
		    return new ActualTypes\ClassType($name);
        } else if (interface_exists($name)) {
		    return new ActualTypes\InterfaceType($name);
		}

		throw new \InvalidArgumentException(sprintf('Class or Interface "%s" is not exists.', $name));
	}

    /**
     * createTypeForValue 
     * 
     * @param mixed $value 
     * @access public
     * @return void
     */
	public function createTypeForValue($value)
	{
		if(is_object($value)) {
			return $this->createType(get_class($value));
		}

		throw new \InvalidArgumentException('Value is not an object.');
	}

    /**
     * isSupportedType 
     * 
     * @param mixed $name 
     * @access public
     * @return void
     */
	public function isSupportedType($name)
	{
        /**
         * _exists($name) 
         * 
         * @package { PACKAGE }
         * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
         * @author Yoshi<yoshi@1o1.co.jp> 
         * @license { LICENSE }
         */
		return class_exists($name) || interface_exists($name);
	}
}

