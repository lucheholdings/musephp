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
class PublicPropertyFieldAccessor extends AbstractFieldAccessor 
{
	/**
	 * propertyReflector 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $propertyReflector;

	/**
	 * __construct 
	 * 
	 * @param mixed $fieldName 
	 * @param \ReflectionProperty $propertyReflector 
	 * @access public
	 * @return void
	 */
	public function __construct($fieldName, \ReflectionProperty $propertyReflector)
	{
		parent::__construct($fieldName);

		$this->propertyReflector = $propertyReflector;
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
    
    /**
     * getPropertyReflector 
     * 
     * @access public
     * @return void
     */
    public function getPropertyReflector()
    {
        return $this->propertyReflector;
    }
    
    /**
     * setPropertyReflector 
     * 
     * @param \Reflector $propertyReflector 
     * @access public
     * @return void
     */
    public function setPropertyReflector(\ReflectionProperty $propertyReflector)
    {
        $this->propertyReflector = $propertyReflector;
        return $this;
    }
}

