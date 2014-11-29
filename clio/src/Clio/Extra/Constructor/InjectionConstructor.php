<?php
namespace Clio\Extra\Constructor;

use Clio\Component\Pattern\Constructor\Constructor,
	Clio\Component\Pattern\Constructor\ProxyConstructor
;
use Clio\Component\Util\Injection\Injector;

/**
 * InjectionConstructor 
 * 
 * @uses ProxyConstructor
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class InjectionConstructor extends ProxyConstructor 
{
	/**
	 * injector 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $injector;

	/**
	 * __construct 
	 * 
	 * @param Constructor $constructor 
	 * @param Injector $injector 
	 * @access public
	 * @return void
	 */
	public function __construct(Constructor $constructor = null, Injector $injector = null)
	{
		parent::__construct($constructor);
		$this->injector = $injector;
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
		$instance = parent::construct($class, $args);

		if($this->injector)
			$this->injector->inject($instance);

		return $instance;
	}
    
    /**
     * getInjector 
     * 
     * @access public
     * @return void
     */
    public function getInjector()
    {
        return $this->injector;
    }
    
    /**
     * setInjector 
     * 
     * @param mixed $injector 
     * @access public
     * @return void
     */
    public function setInjector(Injector $injector)
    {
        $this->injector = $injector;
        return $this;
    }
}

