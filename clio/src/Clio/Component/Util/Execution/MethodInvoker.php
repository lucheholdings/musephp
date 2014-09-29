<?php
namespace Clio\Component\Util\Execution;

/**
 * MethodInvoker 
 * 
 * @uses Invoker
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class MethodInvoker extends Invoker 
{
	/**
	 * object 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $object;

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
	 * @param mixed $object 
	 * @param mixed $method 
	 * @access public
	 * @return void
	 */
	public function __construct($object, $method)
	{
		$this->object = $object;
		$this->method = $method;
	}

	/**
	 * doInvokeArgs 
	 * 
	 * @param array $args 
	 * @access protected
	 * @return void
	 */
	protected function doInvokeArgs(array $args)
	{
		return call_user_func_array(array($this->object, $this->method), $args);
	}
    
    /**
     * getObject 
     * 
     * @access public
     * @return void
     */
    public function getObject()
    {
        return $this->object;
    }
    
    /**
     * setObject 
     * 
     * @param mixed $object 
     * @access public
     * @return void
     */
    public function setObject($object)
    {
        $this->object = $object;
        return $this;
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

