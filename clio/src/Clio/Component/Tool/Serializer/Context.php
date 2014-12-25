<?php
namespace Clio\Component\Tool\Serializer;

/**
 * Context 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class Context 
{
	/**
	 * params 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $params;

	/**
	 * has 
	 * 
	 * @param mixed $name 
	 * @access public
	 * @return void
	 */
	public function has($name)
	{
		return isset($this->params[$name]);
	}

	/**
	 * get 
	 * 
	 * @param mixed $name 
	 * @param mixed $default 
	 * @access public
	 * @return void
	 */
	public function get($name, $default = null)
	{
		return isset($this->params[$name]) ? $this->params[$name] : $default;
	}
	
	/**
	 * set 
	 * 
	 * @param mixed $name 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function set($name, $value)
	{
		$this->params[$name] = $value;
	}

    /**
     * all 
     * 
     * @access public
     * @return void
     */
    public function all()
    {
        return $this->params;
    }
    
    /**
     * replace 
     * 
     * @param array $params 
     * @access public
     * @return void
     */
    public function replace(array $params)
    {
        $this->params = $params;
        return $this;
    }
}

