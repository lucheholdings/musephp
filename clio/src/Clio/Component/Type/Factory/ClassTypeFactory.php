<?php
namespace Clio\Component\Type\Factory;

use Clio\Component\Type\Actual as ActualTypes;
use Clio\Component\Pattern\Factory;

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
     * doCreateType 
     * 
     * @param mixed $name 
     * @param array $options 
     * @access protected
     * @return void
     */
	protected function doCreateType($name, array $options)
	{
		if(class_exists($name)) { 
		    return new ActualTypes\ClassType($name);
        } else if (interface_exists($name)) {
		    return new ActualTypes\InterfaceType($name);
		}

		throw new Factory\Exception\UnsupportedException(sprintf('Class or Interface "%s" is not exists.', $name));
	}
}

