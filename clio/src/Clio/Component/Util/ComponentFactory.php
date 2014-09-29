<?php
namespace Clio\Component\Util;

/**
 * ComponentFactory 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ComponentFactory 
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
		if($class instanceof \ReflectionClass) {
			$this->reflectionClass = $class;
		} else {
			$this->reflectionClass = new \ReflectionClass($class);
		}
	}

	/**
	 * create 
	 * 
	 * @access public
	 * @return void
	 */
	public function create()
	{
		return $this->getReflectionClass()->newInstanceArgs(func_get_args());
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
    
    /**
     * Set reflectionClass.
     *
     * @access public
     * @param reflectionClass the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setReflectionClass($reflectionClass)
    {
        $this->reflectionClass = $reflectionClass;
        return $this;
    }
}

