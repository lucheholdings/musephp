<?php
namespace Terpsichore\Bundle\OAuth2ServerBundle\Storage\Strategy\Factory;

use Symfony\Component\DependencyInjection\ContainerAwareInterface,
	Symfony\Component\DependencyInjection\ContainerInterface
;
/**
 * ServiceStrategyFactory 
 * 
 * @uses ClientProviderFactory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ServiceStrategyFactory implements ClientProviderFactory, 
	UserProviderFactory,
	TokenManagerFactory,
	ContainerAwareInterface
{
	/**
	 * container 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $container;

	/**
	 * __construct 
	 * 
	 * @param ContainerInterface $container 
	 * @access public
	 * @return void
	 */
	public function __construct(ContainerInterface $container)
	{
		$this->container = $container;
	}

	/**
	 * createTokenManager 
	 * 
	 * @param mixed $connectTo 
	 * @param array $options 
	 * @access public
	 * @return void
	 */
	public function createTokenManager($connectTo, array $options = array())
	{
		return $this->get($connectTo);
	}

	/**
	 * createClientProvider 
	 * 
	 * @param mixed $connectTo 
	 * @param array $options 
	 * @access public
	 * @return void
	 */
	public function createClientProvider($connectTo, array $options = array())
	{
		return $this->get($connectTo);
	}

	/**
	 * createUserProvider 
	 * 
	 * @param mixed $connectTo 
	 * @param array $options 
	 * @access public
	 * @return void
	 */
	public function createUserProvider($connectTo, array $options = array())
	{
		return $this->get($connectTo);
	}
    
    /**
     * Get container.
     *
     * @access public
     * @return container
     */
    public function getContainer()
    {
        return $this->container;
    }
    
    /**
     * Set container.
     *
     * @access public
     * @param container the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
        return $this;
    }

	/**
	 * get 
	 * 
	 * @param mixed $serviceId 
	 * @access public
	 * @return void
	 */
	public function get($serviceId)
	{
		return $this->getContainer()->get($serviceId);
	}
}
