<?php
namespace Clio\Component\Util\Type;

/**
 * ClassType 
 * 
 * @uses AbstractType
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class ClassType extends AbstractType 
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
		case PrimitiveTypes::TYPE_OBJECT:
			return true;
		default:
			return ($type == $this->getName()) || $this->isExtends($type) || $this->isImplements($type);
		}
	}

	/**
	 * isImplements 
	 * 
	 * @param mixed $type 
	 * @access public
	 * @return void
	 */
	public function isImplements($type)
	{
		return $this->getReflector()->isImplement($type);
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

