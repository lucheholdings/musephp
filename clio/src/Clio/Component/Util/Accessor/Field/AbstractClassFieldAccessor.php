<?php
namespace Clio\Component\Util\Accessor\Field;

/**
 * AbstractClassFieldAccessor 
 * 
 * @uses AbstractFieldAccessor
 * @abstract
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class AbstractClassFieldAccessor extends AbstractFieldAccessor
{
	/**
	 * __construct 
	 * 
	 * @param \ClassReflector $reflectionClass 
	 * @param mixed $fieldName 
	 * @access public
	 * @return void
	 */
	public function __construct($fieldName)
	{
		parent::__construct($fieldName);
	}

	/**
	 * initFieldReflector 
	 * 
	 * @param \ReflectionClass $classReflector 
	 * @param mixed $fieldName 
	 * @abstract
	 * @access protected
	 * @return void
	 */
	abstract protected function initFieldReflector(\ReflectionClass $classReflector, $fieldName);

	/**
	 * getClassReflector 
	 * 
	 * @access public
	 * @return void
	 */
	public function getClassReflector()
	{
		return $this->classReflector;
	}
}

