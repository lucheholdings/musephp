<?php
namespace Calliope\Core\Filter;

class ParameterMap 
{
	/**
	 * params 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $params;

	/**
	 * __construct 
	 * 
	 * @param array $params 
	 * @access public
	 * @return void
	 */
	public function __construct(array $params = array())
	{
		$this->params = $params;
	}

	/**
	 * has 
	 * 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function has($key)
	{
		return isset($this->params[$key]);
	}

	/**
	 * get 
	 * 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function get($key, $default = null)
	{
		return isset($this->params[$key]) ? $this->params[$key] : $default;
	}

	/**
	 * set 
	 * 
	 * @param mixed $key 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function set($key, $value)
	{
		$this->params[$key] = $value;
	}

	public function all()
	{
		return $this->params;
	}

	public function replaceAll(array $params)
	{
		$this->params = $params;
	}
}

