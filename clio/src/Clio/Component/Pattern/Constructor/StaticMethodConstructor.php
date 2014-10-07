<?php
namespace Clio\Component\Pattern\Constructor;

/**
 * StaticMethodConstructor 
 *   Construct instance with static method. 
 * 
 *   This constructor is to delegate construction with the same params.
 *   like "createXxxWithOptions" or "createXxxForFactory"
 * 
 * @uses Constructor
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class StaticMethodConstructor implements Constructor 
{
	/**
	 * method 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $method;

	/**
	 * __construct 
	 * 
	 * @param mixed $method 
	 * @access public
	 * @return void
	 */
	public function __construct($method)
	{
		$this->method = $method;
	}

	/**
	 * construct 
	 * 
	 * @param \ReflectionClass $class 
	 * @param array $args 
	 * @access public
	 * @return void
	 */
	public function construct(\ReflectionClass $class, array $args = array())
	{
		return $class->getMethod($this->getMethod())->invokeArgs(null, $args);
	}
    
    /**
     * getMethod 
     * 
     * @access public
     * @return void
     */
    public function getMethod()
    {
        return $this->method;
    }
    
    /**
     * setMethod 
     * 
     * @param mixed $method 
     * @access public
     * @return void
     */
    public function setMethod($method)
    {
        $this->method = $method;
        return $this;
    }
}

