<?php
namespace Clio\Component\Pce\Injection;

/**
 * MethodInjection 
 * 
 * @uses AbstractObjectInjection
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class MethodInjection extends AbstractObjectInjection 
{
	/**
	 * method 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $method;

	/**
	 * args 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $args;

	/**
	 * __construct 
	 * 
	 * @param mixed $method 
	 * @param array $args 
	 * @access public
	 * @return void
	 */
	public function __construct($method, array $args = array())
	{
		$this->method = $method;
		$this->args = array_values($args);
	}

	/**
	 * inject 
	 * 
	 * @param mixed $object 
	 * @access public
	 * @return void
	 */
	public function inject($object)
	{
		$args = $this->resolveConstants($this->args);

		try {
			call_user_func_array(array($object, $this->method), $args);
		} catch(\Exception $ex) {
			throw new \RuntimeException(sprintf('Failed to inject method "%s"', $this->method), 0, $ex);
		}

		return $object;
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
    
    /**
     * getArgs 
     * 
     * @access public
     * @return void
     */
    public function getArguments()
    {
        return $this->args;
    }
    
    /**
     * setArgs 
     * 
     * @param mixed $args 
     * @access public
     * @return void
     */
    public function setArguments(array $args)
    {
        $this->args = array_values($args);
        return $this;
    }

	/**
	 * addArgument 
	 * 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function addArgument($value)
	{
		array_push($this->args, $value);

		return $this;
	}

	/**
	 * replaceArgument 
	 * 
	 * @param mixed $idx 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function replaceArgument($idx, $value)
	{
		$this->args[$idx] = $value;
		return $this;
	}
}

