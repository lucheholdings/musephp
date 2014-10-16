<?php
namespace Clio\Component\Util\FieldAccessor\Property;

/**
 * PublicPropertyFieldAccessor 
 * 
 * @uses PropertyFieldAccessor
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class PublicPropertyFieldAccessor extends AbstractClassFieldAccessor 
{
	/**
	 * fieldReflector 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $fieldReflector;

	/**
	 * initFieldReflector 
	 *   Validate after initialized the field 
	 * 
	 * @access protected
	 * @return void
	 */
	protected function initFieldReflector(\ReflectionClass $classReflector, $fieldName)
	{
		if(!$classReflector->hasProperty($fieldName)) {
			throw new \InvalidArgumentException(sprintf('Class "%s" dose not have property "%s"', $classReflector->getName(), $fieldName));
		} else if(!$classReflector->getProperty($this->getFieldName())->isPublic()) {
			throw new \InvalidArgumentException(sprintf('"%s::%s" is not a public access.', $classReflector->getName(), $fieldName));
		}

		$this->setFieldReflector($classReflector->getProperty($fieldName));
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
		$this->getFieldReflector()->setValue($object, $value);
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
		return $this->getFieldReflector()->getValue($object);
	}
    
    /**
     * getFieldReflector 
     * 
     * @access public
     * @return void
     */
    public function getFieldReflector()
    {
        return $this->fieldReflector;
    }
    
    /**
     * setFieldReflector 
     * 
     * @param \Reflector $fieldReflector 
     * @access public
     * @return void
     */
    public function setFieldReflector(\Reflector $fieldReflector)
    {
        $this->fieldReflector = $fieldReflector;
        return $this;
    }
}

