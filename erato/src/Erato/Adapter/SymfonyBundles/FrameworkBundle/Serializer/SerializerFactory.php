<?php
namespace Erato\Adapter\SymfonyBundles\FrameworkBundle\Serializer;

use Clio\Component\Serializer\Serializer,
	Clio\Component\Serializer\SerializerFactory as BaseFactory,
	Clio\Component\Serializer\Strategy,
	Clio\Component\Serializer\Adapter\AdapterFactoryInterface;



/**
 * SerializerFactory 
 * 
 * @uses BaseFactory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class SerializerFactory extends BaseFactory 
{
	/**
	 * adapterFactory 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $adapterFactory;

	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct(AdapterFactoryInterface $adapterFactory)
	{
		$this->adapterFactory = $adapterFactory;
	}

	/**
	 * createSerializerFromService 
	 * 
	 * @param mixed $service 
	 * @access public
	 * @return void
	 */
	public function createSerializerFromService($service)
	{
		if($service instanceof Strategy) {
			$strategy = $service;
		} else {
			$strategy = $this->createAdapter($service);
		}

		return new Serializer($strategy);
	}

	/**
	 * createAdapter 
	 * 
	 * @param mixed $service 
	 * @access protected
	 * @return void
	 */
	public function createAdapter($service)
	{
		return $this->getAdapterFactory()->createAdapter($service);
	}
    
    /**
     * Get adapterFactory.
     *
     * @access public
     * @return adapterFactory
     */
    public function getAdapterFactory()
    {
        return $this->adapterFactory;
    }
    
    /**
     * Set adapterFactory.
     *
     * @access public
     * @param adapterFactory the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setAdapterFactory($adapterFactory)
    {
        $this->adapterFactory = $adapterFactory;
        return $this;
    }
}

