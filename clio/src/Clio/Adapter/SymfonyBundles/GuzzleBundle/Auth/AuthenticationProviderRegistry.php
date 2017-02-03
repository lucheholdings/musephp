<?php
namespace Clio\Adapter\SymfonyBundles\GuzzleBundle\Auth;

/**
 * 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license MIT
 */
class AuthenticationProviderRegistry implements \ArrayAccess
{
	/**
	 * providers 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $providers;

	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct()
	{
		$this->providers = array();
	}


	/**
	 * offsetGet 
	 * 
	 * @param mixed $name 
	 * @access public
	 * @return void
	 */
	public function offsetGet($name)
	{
		if(!array_key_exists($name, $this->providers)) {
			return null;
		}
		return $this->providers[$name];
	}

	/**
	 * offsetSet 
	 * 
	 * @param mixed $name 
	 * @param mixed $provider 
	 * @access public
	 * @return void
	 */
	public function offsetSet($name, $provider)
	{
		$this->providers[$name] = $provider;
	}

	/**
	 * offsetExists 
	 * 
	 * @param mixed $name 
	 * @access public
	 * @return void
	 */
	public function offsetExists($name)
	{
		return array_key_exists($name, $this->providers);
	}

	/**
	 * offsetUnset 
	 * 
	 * @param mixed $name 
	 * @access public
	 * @return void
	 */
	public function offsetUnset($name)
	{
		unset($this->providers[$name]);
	}

	/**
	 * add 
	 * 
	 * @param mixed $name 
	 * @param mixed $provider 
	 * @access public
	 * @return void
	 */
	public function add($name, $provider)
	{
		$this->offsetSet($name, $provider);

		return $this;
	}

	/**
	 * get 
	 * 
	 * @param mixed $name 
	 * @access public
	 * @return void
	 */
	public function get($name)
	{
		return $this[$name];
	}
}


