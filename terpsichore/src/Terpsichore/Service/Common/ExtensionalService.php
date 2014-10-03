<?php
namespace Terpsichore\Service;

use Terpsichore\Core\Request;
use Terpsichore\Core\Service\AbstractClientService;

/**
 * ExtensionalService 
 * 
 * @uses AbstractClientService
 * @abstract
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class ExtensionalService extends AbstractClientService
{
	/**
	 * _parent 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $_parent;

	/**
	 * request 
	 * 
	 * @param Request $request 
	 * @access public
	 * @return void
	 */
	public function request(Request $request)
	{
		$this->getParent()->request($request);
	}

	/**
	 * addService 
	 * 
	 * @param mixed $name 
	 * @param mixed $method 
	 * @access public
	 * @return void
	 */
	public function addService($name, $method)
	{
		if(is_string($method)) {
			$this->services[$name] = new MethodInvoker($this, $method);
		} else if(is_array($method) && is_callable($method)) {
			$this->services[$name] = new ArrayInvoker($method);
		} else if($method instanceof Invoker) {
			$this->services[$name] = $method;
		} else {
			throw new \InvalidArgumentException('Service is not invokable.');
		}

		return $this;
	}

	/**
	 * getServiceInvoker 
	 * 
	 * @param mixed $name 
	 * @access public
	 * @return void
	 */
	public function getServiceInvoker($name)
	{
		return $this->calls[$name];
	}
    
    /**
     * getParent 
     * 
     * @access public
     * @return void
     */
    public function getParent()
    {
		if(!$this->_parent) {
			throw new \RuntimeException('ExtensionalService has to be initialized with Parent Service.');
		}
        return $this->_parent;
    }
    
    /**
     * setParent 
     * 
     * @param ClientService $parent 
     * @access public
     * @return void
     */
    public function setParent(ClientService $parent)
    {
        $this->parent = $parent;
        return $this;
    }
}

