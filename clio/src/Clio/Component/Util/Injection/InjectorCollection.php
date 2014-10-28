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
	 * injecctors 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $injecctors;

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
     * getInjecctors 
     * 
     * @access public
     * @return void
     */
    public function getInjecctors()
    {
        return $this->injecctors;
    }
    
    /**
     * setInjecctors 
     * 
     * @param mixed $injecctors 
     * @access public
     * @return void
     */
    public function setInjecctors($injecctors)
    {
        $this->injecctors = $injecctors;
        return $this;
    }
}

