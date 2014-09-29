<?php
namespace Clio\Component\Util\Validator;

/**
 * ClassValidator 
 * 
 * @uses Validator
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ClassValidator implements Validator
{
	/**
	 * reflectionClass 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $reflectionClass;

	/**
	 * __construct 
	 * 
	 * @param mixed $class 
	 * @access public
	 * @return void
	 */
	public function __construct($class)
	{
		if(!$class instanceof \ReflectionClass) {
			$this->reflectionClass = new \ReflectionClass($class);
		} else {
			$this->reflectionClass = $class;
		}
	}

	/**
	 * validate 
	 * 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function validate($value)
	{
		if(!$this->getReflectionClass()->isInstance($value)) {
			throw new Error\ValidationError(sprintf('"%s" is not an instanceof "%s".', get_class($value), $this->getReflectionClass()->getName()));
		}

		return $value;
	}
    
    /**
     * Get reflectionClass.
     *
     * @access public
     * @return reflectionClass
     */
    public function getReflectionClass()
    {
        return $this->reflectionClass;
    }
}
