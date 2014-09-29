<?php
namespace Clio\Component\Util\Container\Collection;

/**
 * ObjectCollection 
 * 
 * @uses Collection
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ObjectCollection extends Collection 
{
	/**
	 * validateClass 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $validateClass;

	/**
	 * defaultClass 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $defaultClass;

	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct(array $values = array())
	{
		parent::__construct();

		//$this->values = $values;
		foreach($values as $key => $value) {
			$this[$key] = $value;
		}
	}

	/**
	 * isSupportedClass 
	 * 
	 * @param mixed $value 
	 * @access protected
	 * @return void
	 */
	protected function isSupportedClass($value)
	{
		if($class = $this->getValidateClassReflection()) {
			return is_object($value) && $class->isInstance($value);
		} else {
			return is_object($value);
		}
	}

	/**
	 * setClass 
	 * 
	 * @param mixed $class 
	 * @access public
	 * @return void
	 */
	public function setClass($defaultClass, $validateClass = null)
	{
		if(is_string($defaultClass)) {
			$defaultClass = new \ReflectionClass($defaultClass);
		} else if (!$defaultClass instanceof \ReflectionClass) {
			throw new \Clio\Component\Exception\InvalidArgumentException('$defaultClass has to be a string or an instanceof of ReflectionClass');
		}

		$this->defaultClass = $defaultClass;

		if(!$validateClass) {
			// Use same class definition with defaultClass
			$this->validateClass = $this->defaultClass;
		} else {
			if(is_string($validateClass)) {
				$validateClass = new \ReflectionClass($validateClass);
			} else if (!$validateClass instanceof \ReflectionClass) {
				throw new \Clio\Component\Exception\InvalidArgumentException('$validateClass has to be a string or an instanceof of ReflectionClass');
			}

			$this->validateClass = $validateClass;
		}
	}

	public function setValidateClass($class)
	{
		if(!$class instanceof \ReflectionClass) {
			$class = new \ReflectionClass($class);
		}

		$this->validateClass = $class;

		return $this;
	}

	/**
	 * getValidateClassReflection 
	 * 
	 * @access protected
	 * @return void
	 */
	protected function getValidateClassReflection()
	{
		return $this->validateClass;
	}

	/**
	 * getDefaultClass 
	 *   Specify default class of the element.
	 *   ObjectColelction dose not use this.
	 *   But to supoprt inherited class to create object from value, 
	 *   defined in ObjectClass.
	 *   
	 * @access public
	 * @return void
	 */
	public function getDefaultClass()
	{
		return $this->defaultClass;
	}

	/**
	 * set
	 * 
	 * @param mixed $key 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function set($key, $value)
	{
		if(!$this->isSupportedClass($value)) {
			throw new \Clio\Component\Exception\InvalidArgumentException(
				sprintf('Given value "%s" is not a valid object.', is_object($value) ? get_class($value) : gettype($value))
			);
		}
		parent::set($key, $value);
	}
}

