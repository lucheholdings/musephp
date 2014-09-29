<?php
namespace Clio\Component\Pce\FieldAccessor\Property;

use Clio\Component\Pce\FieldAccessor\AbstractFieldAccessor;
use Clio\Component\Pce\FieldAccessor\Mapping\ClassMapping;
/**
 * AbstractPropertyFieldAccessor 
 * 
 * @uses AbstractPropertyAccessor
 * @uses PropertyFieldAccessor
 * @abstract
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class AbstractPropertyFieldAccessor extends AbstractFieldAccessor implements PropertyFieldAccessor 
{
	/**
	 * field 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $field;

	/**
	 * __construct 
	 * 
	 * @param ClassMapping $classMapping 
	 * @param mixed $field 
	 * @access public
	 * @return void
	 */
	public function __construct(ClassMapping $classMapping, $field, array $options = array())
	{
		parent::__construct($classMapping, $options);

		$this->field = $field;
	}
    
    /**
     * Get field.
     *
     * @access public
     * @return field
     */
    public function getField()
    {
        return $this->field;
    }
    
    /**
     * Set field.
     *
     * @access public
     * @param field the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setField($field)
    {
        $this->field = $field;
        return $this;
    }

	protected function validateField($field)
	{
		if($this->field != $field) {
			throw new \Clio\Component\Exception\InvalidArgumentException(sprintf('%s is only for field "%s", but "%s" is given.', get_class($this), $this->field, $field)); 
		}
	}

	/**
	 * set 
	 * 
	 * @param mixed $object 
	 * @param mixed $field 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function set($object, $field, $value)
	{
		$this->validateField($field);
		
		return $this->setValue($object, $value);
	}

	/**
	 * get 
	 * 
	 * @param mixed $object 
	 * @param mixed $field 
	 * @access public
	 * @return void
	 */
	public function get($object, $field)
	{
		$this->validateField($field);

		return $this->getValue($object);
	}

	/**
	 * isNull 
	 * 
	 * @param mixed $object 
	 * @param mixed $field 
	 * @access public
	 * @return void
	 */
	public function isNull($object, $field)
	{
		$this->validateField($field);
	
		return $this->isValueNull($object);
	}

	/**
	 * clear 
	 * 
	 * @param mixed $object 
	 * @param mixed $field 
	 * @access public
	 * @return void
	 */
	public function clear($object, $field)
	{
		$this->validateField($field);
		return $this->clearValue($object);
	}

	/**
	 * clearValue 
	 * 
	 * @access public
	 * @return void
	 */
	public function isValueNull($object)
	{
		return (null === $this->getValue($object));
	}

	/**
	 * clearValue 
	 * 
	 * @param mixed $object 
	 * @access public
	 * @return void
	 */
	public function clearValue($object)
	{
		return $this->setValue($object, null);
	}

	/**
	 * getReflectionProperty 
	 * 
	 * @access public
	 * @return void
	 */
	public function getFieldReflectionProperty()
	{
		try {
			$reflection = $this->getClassMapping()->getReflectionClass()->getProperty($this->field);
		} catch (\ReflectionException $ex) {
			throw new \Clio\Component\Exception\Exception(sprintf('Property %s::%s does not exist', $this->getClassMapping()->getNamespacedName(), $this->field), 0, $ex);
		}

		return $reflection;
	}

	/**
	 * getFieldNames 
	 * 
	 * @access public
	 * @return void
	 */
	public function getFieldNames($object = null)
	{
		return array($this->field);
	}

	/**
	 * getFields 
	 * 
	 * @param mixed $object 
	 * @access public
	 * @return void
	 */
	public function getFields($object)
	{
		return array($this->getField() => $this->getValue($object));
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
		return ($field === $this->field);
	}
}

