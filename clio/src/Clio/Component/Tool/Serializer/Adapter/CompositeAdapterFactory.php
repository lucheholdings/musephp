<?php
namespace Clio\Component\Tool\Serializer\Adapter;

use Clio\Component\Tool\Serializer\Strategy;

/**
 * CompositeAdapterFactory 
 * 
 * @uses AdapterFactoryInterface
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class CompositeAdapterFactory implements AdapterFactoryInterface 
{
	/**
	 * factories 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $factories;

	/**
	 * __construct 
	 * 
	 * @param array $factories 
	 * @access public
	 * @return void
	 */
	public function __construct(array $factories = array())
	{
		$this->factories = array();

		foreach($factories as $factory) {
			$this->addFactory($factory);
		}
	}

	/**
	 * isSupportAdaptee 
	 * 
	 * @param mixed $adaptee 
	 * @access public
	 * @return void
	 */
	public function isSupport($adaptee)
	{
		if($adaptee instanceof Strategy) {
			return true;
		}

		foreach($this->factories as $factory) {
			if($factory->isSupport($adaptee)) {
				return true;
			}
		}

		return false;
	}

	/**
	 * createAdapter
	 * 
	 * @param mixed $adaptee 
	 * @access public
	 * @return void
	 */
	public function createAdapter($adaptee)
	{
		if($adaptee instanceof Strategy) {
			return $adaptee;
		}

		foreach($this->factories as $factory) {
			if($factory->isSupport($adaptee)) {
				return $factory->createAdapter($adaptee);
			}
		}

		throw new \Clio\Component\Exception\RuntimeException(sprintf('No factory support for class "%s".', get_class($adaptee)));
	}
    
    /**
     * Get factories.
     *
     * @access public
     * @return factories
     */
    public function getFactories()
    {
        return $this->factories;
    }
    
    /**
     * Set factories.
     *
     * @access public
     * @param factories the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setFactories($factories)
    {
		foreach($factories as $factory) {
			$this->addFactory($factory);
		}
    }

	/**
	 * addFactory 
	 * 
	 * @param AdapterFactoryInterface $factory 
	 * @access public
	 * @return void
	 */
	public function addFactory(AdapterFactoryInterface $factory)
	{
		$this->factories[] = $factory;

		return $this;
	}
}
