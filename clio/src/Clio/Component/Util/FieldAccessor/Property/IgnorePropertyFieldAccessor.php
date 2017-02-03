<?php
namespace Clio\Component\Util\FieldAccessor\Property;

use Clio\Component\Util\FieldAccessor\Mapping\ClassMapping;

class IgnorePropertyFieldAccessor extends AbstractPropertyFieldAccessor 
{
	/**
	 * __construct 
	 * 
	 * @param ClassMapping $classMapping 
	 * @param mixed $field 
	 * @access public
	 * @return void
	 */
	public function __construct(ClassMapping $classMapping, $field)
	{
		parent::__construct($classMapping, $field);
	}

	/**
	 * setValue 
	 * 
	 * @param mixed $object 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function setValue($object, $value)
	{
		return $this;
	}

	/**
	 * getValue 
	 * 
	 * @param mixed $object 
	 * @access public
	 * @return void
	 */
	public function getValue($object)
	{
		return null;
	}

	/**
	 * isSupportMethod 
	 * 
	 * @param mixed $object 
	 * @param mixed $field 
	 * @param mixed $type 
	 * @access public
	 * @return void
	 */
	public function isSupportMethod($object, $field, $type)
	{
		return true;
	}
}
