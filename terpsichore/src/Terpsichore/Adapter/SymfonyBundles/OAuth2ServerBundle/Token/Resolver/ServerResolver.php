<?php
namespace Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Token\Resolver;

use Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Token\Resolver;

use Symfony\Component\HttpFoundation\Request;
/**
 * ServerResolver 
 *   ServerResolver is a RequestTokenResolver with OAuth2 Server. 
 *   Either this server include the OAuth2 AuthProvider or 
 *   this server can point the storage of the AuthProvider,
 *   you can use ServerResolver.
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ServerResolver implements Resolver
{
	/**
	 * serverService 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $serverService;

	/**
	 * __construct 
	 * 
	 * @param \OAuth2\Server $serverService 
	 * @access public
	 * @return void
	 */
	public function __construct(\OAuth2\Server $serverService = null)
	{
		$this->serverService = $serverService;
	}

	/**
	 * resolveToken 
	 * 
	 * @param Request $request 
	 * @access public
	 * @return void
	 */
	public function resolveToken(Request $request)
	{
		if(!$this->getServerService()->verifyResourceRequest(\OAuth2\HttpFoundationBridge\Request::createFromRequest($request), $response = new \OAuth2\HttpFoundationBridge\Response())) {
			return;
		}

		$token = $this->getServerService()->getResourceController()->getToken();

		return $token['object'];
	}
    
    /**
     * Get serverService.
     *
     * @access public
     * @return serverService
     */
    public function getServerService()
    {
		if(!$this->serverService) {
			throw new \Exception('OAuth2 Server is not initialized yet.');
		}
        return $this->serverService;
    }
    
    /**
     * Set serverService.
     *
     * @access public
     * @param serverService the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setServerService(\OAuth2\Server $serverService)
    {
        $this->serverService = $serverService;
        return $this;
    }
}

