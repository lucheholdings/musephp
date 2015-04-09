<?php
namespace Clio\Component\Util\Type\Actual;

use Clio\Component\Util\Type\PrimitiveTypes;

/**
 * InterfaceType 
 * 
 * @uses AbstractType
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class InterfaceType extends ClassType 
{
	/**
	 * __construct 
	 * 
	 * @param mixed $name 
	 * @access public
	 * @return void
	 */
	public function __construct($name)
	{
        if(!interface_exists($name)) {
            throw new \InvalidArgumentException(sprintf('Interface "%s" is not exists.', $name));
        }

        $this->reflector = new \ReflectionClass($name);

		AbstractType::__construct($name);
	}

	/**
	 * isType 
	 * 
	 * @param mixed $type 
	 * @access public
	 * @return void
	 */
	public function isType($type)
	{
		$type = (string)$type;

		switch($type) {
		case PrimitiveTypes::TYPE_INTERFACE:
			return true;
		default:
			return ($this->isName($type) || $this->isImplements($type));
		}
	}
}

