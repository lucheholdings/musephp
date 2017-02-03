<?php
namespace Clio\Component\Util\Container\Validator;

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
			throw new \Clio\Component\Exception\RuntimeException(sprintf('ClassValidator failed. Has to be an instance of "%s", but "%s" is given.', $this->getReflectionClass()->getName(), get_class($value)));
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
