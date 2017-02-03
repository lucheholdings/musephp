<?php
namespace Clio\Adapter\SymfonyBundles\GuzzleBundle\Auth\Builder;


use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\ServiceCircularReferenceException;

use Clio\Component\Auth\OAuth2\Token\ClientTokenInterface,
	Clio\Component\Auth\OAuth2\Token\ClientTokenAwareInterface,
	Clio\Component\Auth\OAuth2\Token\ServerTokenAwareInterface,
	Clio\Component\Auth\OAuth2\Token\Provider\TokenProviderInterface,
	Clio\Component\Auth\OAuth2\Token\ChainedToken
;
/**
 * 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license MIT
 */
class OAuth2PluginBuilder
{
	/**
	 * container 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $container;

	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct(ContainerInterface $container)
	{
		$this->container = $container;
	}

	/**
	 * build 
	 * 
	 * @param ClientTokenInterface $defaultToken 
	 * @param mixed $tokenProvider 
	 * @param array $configs 
	 * @access public
	 * @return void
	 */
	public function build(ClientTokenInterface $clientToken = null, TokenProviderInterface $tokenProvider = null, array $configs = array())
	{
		// Default Class "Clio\Adapter\GuzzlePlugin\OAuth2\OAuth2Plugin"
		$class = $this->container->getParameter('clio.guzzle.plugin.oauth2.class'); 

		if(!$clientToken) {
			// Get Access Token from SecurityContext
			try {
				if($this->container->has('security.context')) {

					$context = $this->container->get('security.context');
					$token = $context->getToken();

					// 
					if($token && ($token instanceof ClientTokenAwareInterface)) {
						$clientToken = $token->getOAuthToken();
					} else if($token && ($token instanceof ServerTokenAwareInterface)) {
						// iff ServerSide, create ChainedToken. Might use for "chain" grant
						$serverToken = $token->getOAuthToken();
						if(!$serverToken) {
							// 
							throw new \Exception('Failed to get OAuth2 Token. Isn\'t it expired?');
						}
						// Create ChainedToken
						$clientToken = new ChainedToken($serverToken);
					}
				}
			} catch(ServiceCircularReferenceException $ex) {
				$clientToken = null;
			}
		}
		
		return new $class($clientToken, $tokenProvider, $configs);
	}
}

