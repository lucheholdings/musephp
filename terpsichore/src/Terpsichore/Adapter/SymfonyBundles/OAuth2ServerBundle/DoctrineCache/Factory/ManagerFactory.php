<?php
namespace Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\DoctrineCache\Factory;

use Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\DoctrineCache\TokenManager;
use Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Storage\Strategy\Factory\TokenManagerFactory;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * ManagerFactory 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ManagerFactory implements TokenManagerFactory
{
	private $container;

	public function __construct(ContainerInterface $container)
	{
		$this->container = $container;
	}

	public function createTokenManager($connectTo, array $options = array())
	{
		// ConnectTo DoctrineCache
		return new TokenManager($this->getContainer()->get($connectTo), $options['class']);
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
    public function setContainer($container)
    {
        $this->container = $container;
        return $this;
    }
}

