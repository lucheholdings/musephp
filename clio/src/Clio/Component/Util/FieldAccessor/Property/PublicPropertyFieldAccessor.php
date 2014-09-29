<?php
namespace Clio\Component\Util\FieldAccessor\Property;

use Clio\Component\Util\FieldAccessor\Mapping\ClassMapping;
/**
 * PublicPropertyFieldAccessor 
 * 
 * @uses PropertyFieldAccessor
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class PublicPropertyFieldAccessor extends AbstractPropertyFieldAccessor 
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

		if(!$this->getFieldReflectionProperty()->isPublic()) {
			throw new \Clio\Component\Exception\Exception('%s::$%s is not a public property.', $classMapping->getNamespacedName(), $property->getName());
		}
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
		$this->getFieldReflectionProperty()->setValue($object, $value);
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
		return $this->getFieldReflectionProperty()->getValue($object);
	}
}

