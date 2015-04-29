<?php
namespace Clio\Component\Type\Factory;

use Clio\Component\Type\Actual as ActualTypes;

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
	public function createType($name, array $options = array())
	{
		if(class_exists($name)) { 
		    return new ActualTypes\ClassType($name);
        } else if (interface_exists($name)) {
		    return new ActualTypes\InterfaceType($name);
		}

		throw new \InvalidArgumentException(sprintf('Class or Interface "%s" is not exists.', $name));
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
		return class_exists($name) || interface_exists($name);
	}
}

