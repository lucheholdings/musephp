<?php
namespace Terpsichore\Client\Service;

use Terpsichore\Client\Service;

/**
 * BasicServiceProvider 
 * 
 * @uses ServiceProvider
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class BasicServiceProvider extends AbstractService implements ServiceProvider 
{
	/**
	 * _services 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $_services;

	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct()
	{
		$this->_services = array();

		$this->init();
	}

	/**
	 * init 
	 * 
	 * @access protected
	 * @return void
	 */
	protected function init()
	{
	}

	/**
	 * hasService 
	 * 
	 * @param mixed $name 
	 * @access public
	 * @return void
	 */
	public function hasService($name)
	{
		return isset($this->_services[$name]);
	}

	/**
	 * getService 
	 * 
	 * @param mixed $name 
	 * @access public
	 * @return void
	 */
	public function getService($name)
	{
		if(!isset($this->_services[$name])) {
			throw new \RuntimeException(sprintf('Service "%s" is not exists on Service "%s".', $name, $this->getName()));
		}

		return $this->_services[$name];
	}

	/**
	 * setService 
	 * 
	 * @param mixed $name 
	 * @param Service $service 
	 * @access public
	 * @return void
	 */
	public function setService($name, Service $service)
	{
		$this->_services[$name] = $service;

		return $this;
	}

	/**
	 * __get 
	 * 
	 * @param mixed $name 
	 * @access public
	 * @return void
	 */
	public function __get($name)
	{
		if(('_' !== $name[0]) && $this->hasService($name)) {
			return $this->getService($name);
		}

		throw new \InvalidArgumentException(sprintf('Propery "%s" is not exists.', $name));
	}
}

