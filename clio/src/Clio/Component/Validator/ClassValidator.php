<?php
namespace Clio\Component\Validator;

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
		$reflector = new \ReflectionClass($value);
		if($reflector != $this->getReflectionClass()) {
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
