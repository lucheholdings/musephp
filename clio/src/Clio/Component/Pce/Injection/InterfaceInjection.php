<?php
namespace Clio\Component\Pce\Injection;

/**
 * InterfaceInjection 
 * 
 * @uses AbsractObjectInjection
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class InterfaceInjection extends AbsractObjectInjection 
{
	private $interface;

	private $injections;

	public function __construct($interface)
	{
		$this->interface = $interface;
	}

	public function inject($object)
	{
		try {
			foreach($this->getInjections() as $injection) {
				$injection->inject($object);
			}
		} catch(\Exception $ex) {
			throw new \RuntimeException(sprintf('Failed to inject interface "%s"', $this->interface), 0, $ex);
		}

		return $object;
	}
    
    public function getInterface()
    {
        return $this->interface;
    }
    
    public function setInterface($interface)
    {
        $this->interface = $interface;
        return $this;
    }
    
    public function getInjections()
    {
        return $this->injections;
    }
    
    public function setInjections(array $injections)
    {
		$this->injections = array();
		foreach($this->injections as $injection) {
			$this->addInjection($injection);
		}
        return $this;
    }

	public function addInjection(MethodInjection $injection) 
	{
		$this->injections[] = $injection;
		return $this;
	}

	public function removeInjection(MethodInjection $injection)
	{
		if(false === ($idx = array_search($injection, $this->injections)) ) {
			throw new \InvalidArgumentException('Given injection is not exists to remove.');
		}
		unset($this->injections[$idx]);

		return $this;
	}
}

