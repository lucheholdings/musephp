<?php
namespace Clio\Component\Util\Injection;

/**
 * InjectorCollection 
 * 
 * @uses Injector
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class InjectorCollection implements Injector 
{
	/**
	 * injectors 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $injectors;

	/**
	 * __construct 
	 * 
	 * @param array $injectors 
	 * @access public
	 * @return void
	 */
	public function __construct(array $injectors = array())
	{
		$this->injectors = array();
		foreach($injectors as $injector) {
			$this->addInjector($injector);
		}
	}

	/**
	 * inject 
	 * 
	 * @param mixed $object 
	 * @param mixed $throwable 
	 * @access public
	 * @return void
	 */
	public function inject($object, $throwable = true) 
	{
		foreach($this->injectors as $injector) {
			$injector->inject($object, $throwable);
		}
	}

	/**
	 * addInjector 
	 * 
	 * @param Injector $injector 
	 * @access public
	 * @return void
	 */
	public function addInjector(Injector $injector)
	{
		$this->injectors[] = $injector;
	}
    
    /**
     * getInjectors 
     * 
     * @access public
     * @return void
     */
    public function getInjectors()
    {
        return $this->injectors;
    }
    
    /**
     * setInjectors 
     * 
     * @param mixed $injectors 
     * @access public
     * @return void
     */
    public function setInjectors($injectors)
    {
        $this->injectors = $injectors;
        return $this;
    }
}

