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
	 * classReflector 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $classReflector;

	/**
	 * __construct 
	 * 
	 * @param \ClassReflector $reflectionClass 
	 * @param mixed $fieldName 
	 * @access public
	 * @return void
	 */
	public function __construct(\ReflectionClass $reflectionClass, $fieldName)
	{
		parent::__construct($fieldName);

		$this->classReflector = $classReflector;

		$this->initFieldReflector($classRefletor, $fieldName);
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

