<?php
namespace Clio\Component\Util\Type;

/**
 * InterfaceType 
 * 
 * @uses AbstractType
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class InterfaceType extends AbstractType 
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
		$this->reflector = new \ReflectionClass($name);

        if(!$this->reflector->isInterface()) {
            throw new \RuntimeException(sprintf('"%s" is a class, but not an interface.'));
        }

		parent::__construct($name);
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
			return ($type == $this->getName()) || $this->isExtends($type);
		}
	}

	/**
	 * isExtends 
	 * 
	 * @param mixed $type 
	 * @access public
	 * @return void
	 */
	public function isExtends($type)
	{
		return $this->getReflector()->isExtends($type);
	}
}

