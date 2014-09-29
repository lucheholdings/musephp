<?php
namespace Clio\Component\Pce\FieldAccessor\Mapping;

use Clio\Component\Util\Psr\Psr;

/**
 * PropertyFieldMapping 
 * 
 * @uses FieldMapping
 * @uses FieldMapping
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class PropertyFieldMapping extends BasicFieldMapping implements FieldMapping
{
	/**
	 * propertyName 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $propertyName;

	/**
	 * __construct 
	 * 
	 * @param \ReflectionClass $class 
	 * @param mixed $field 
	 * @param mixed $property 
	 * @access public
	 * @return void
	 */
	public function __construct(ClassMapping $classMapping, $field, $property = null) 
	{
		parent::__construct($classMapping, $field);
		if(!$property) {
			$property = $field;
		}
		
		$this->propertyName = $property;
	}

	/**
	 * getReflectionProperty 
	 * 
	 * @access public
	 * @return void
	 */
	public function getReflectionProperty()
	{
		return $this->getClassMapping()->getReflectionClass()->getProperty($this->getPropertyName());
	}

    /**
     * Get propertyName.
     *
     * @access public
     * @return propertyName
     */
    public function getPropertyName()
    {
        return $this->propertyName;
    }
    
    /**
     * Set propertyName.
     *
     * @access public
     * @param propertyName the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setPropertyName($propertyName)
    {
        $this->propertyName = $propertyName;
        return $this;
    }
}

