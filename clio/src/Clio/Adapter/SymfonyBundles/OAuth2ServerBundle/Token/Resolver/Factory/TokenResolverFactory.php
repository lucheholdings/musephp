<?php
namespace Clio\Adapter\SymfonyBundles\OAuth2ServerBundle\Token\Resolver\Factory;

use Clio\Adapter\SymfonyBundles\OAuth2ServerBundle\Token\Resolver as Resolver;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * TokenResolverFactory 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class TokenResolverFactory 
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
	public function __construct(ContainerInterface $container = null)
	{
		$this->container = $container;
	}

	/**
	 * createResolver 
	 * 
	 * @access public
	 * @return void
	 */
	public function createResolver($type, $provider, $cache = null)
	{
		switch($type) {
		case 'server':
			$resolver = new Resolver\ServerTokenResolver($provider);
			break;
		case 'tokeninfo':
			$resolver = new Resolver\TokeninfoTokenResolver($provider);
			break;
		case 'chain_grant':
			$resolver = new Resolver\ChainedTokenResolver($provider);
			break;
		default:
			throw new \Exception(sprintf('Invalid type "%s" is specified.', $type));
			break;
		}

		if($cache && ($resolver instanceof Resolver\ClientTokenResolver)) {
			$resolver = new Resolver\CachedClientTokenResolver($resolver, $cache);
		}

		return $resolver;
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

