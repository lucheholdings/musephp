<?php
namespace Clio\Component\Util\Accessor\Field;

/**
 * PublicPropertyFieldAccessor 
 * 
 * @uses PropertyFieldAccessor
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class PublicPropertyFieldAccessor extends AbstractSingleFieldAccessor 
{
	/**
	 * propertyReflector 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $propertyReflector;

	public function __construct($fieldName, \ReflectionProperty $propertyReflector)
	{
		parent::__construct($fieldName);
		$this->propertyReflector = $propertyReflector;
	}

	/**
	 * getPropertyReflector 
	 * 
	 * @access protected
	 * @return void
	 */
	protected function getPropertyReflector()
	{
		return $this->propertyReflector;
	}

	/**
	 * set
	 * 
	 * @param mixed $object 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function set($object, $value)
	{
		$this->getPropertyReflector()->setValue($object, $value);
		return $this;
	}

	/**
	 * get
	 * 
	 * @param mixed $object 
	 * @access public
	 * @return void
	 */
	public function get($object)
	{
		return $this->getPropertyReflector()->getValue($object);
	}
}

