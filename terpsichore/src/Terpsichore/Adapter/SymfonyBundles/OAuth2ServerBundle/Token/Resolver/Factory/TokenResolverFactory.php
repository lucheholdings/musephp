<?php
namespace Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Token\Resolver\Factory;

use Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Token\Resolver\Factory;
use Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Token\Resolver as Resolver;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Clio\Component\Pattern\Factory\MappedFactory;

/**
 * TokenResolverFactory 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class TokenResolverFactory implements Factory, MappedFactory 
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
	 * createResolver 
	 * 
	 * @access public
	 * @return void
	 */
	public function createTokenResolver($type, array $options = array())
	{
		switch($type) {
		case 'server':
			// Validate the request token with OAuth2 Server
			$resolver = new Resolver\ServerResolver($this->getContainer()->get('terpsichore_oauth2_server.server'));
			break;
		case 'trust':
			$resolver = new Resolver\TrustedResolver();
			break;
		default:
			throw new \Exception(sprintf('Invalid Token Resolver type "%s" is specified.', $type));
			break;
		}

		return $resolver;
	}

	public function createByKey()
	{
		$args = func_get_args();
		$key = array_shift($args);

		return $this->createByKeyArgs($key, $args);
	}

	public function createByKeyArgs($key, array $args = array())
	{
		return $this->createTokenResolver($key, array_shift($args));
	}

	public function isSupportedArgs(array $args = array())
	{
		$key = array_shift($args);
		return isSupportedKeyArgs($key, $args);
	}

	public function isSupportedKeyArgs($key, array $args = array())
	{
		switch($key) {
		case 'server':
		case 'trust':
			return true;
		default:
			return false;
		}
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

