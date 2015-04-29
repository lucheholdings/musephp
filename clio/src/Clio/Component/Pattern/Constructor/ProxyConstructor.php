<?php
namespace Clio\Component\Pattern\Constructor;

/**
 * ProxyConstructor 
 * 
 * @uses Constructor
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class ProxyConstructor implements Constructor 
{
	/**
	 * constructor 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $constructor;

	/**
	 * __construct 
	 * 
	 * @param Constructor $constructor 
	 * @access public
	 * @return void
	 */
	public function __construct(Constructor $constructor = null)
	{
		$this->constructor = $constructor;
	}

	/**
	 * construct 
	 * 
	 * @param \ReflectionClass $class 
	 * @param array $args 
	 * @access public
	 * @return void
	 */
	public function construct(\ReflectionClass $class = null, array $args = array())
	{
		return $this->getConstructor()->construct($class, $args);
	}
    
    /**
     * getConstructor 
     * 
     * @access public
     * @return void
     */
    public function getConstructor()
    {
        return $this->constructor;
    }
    
    /**
     * setConstructor 
     * 
     * @param Constructor $constructor 
     * @access public
     * @return void
     */
    public function setConstructor(Constructor $constructor)
    {
        $this->constructor = $constructor;
        return $this;
    }
}

