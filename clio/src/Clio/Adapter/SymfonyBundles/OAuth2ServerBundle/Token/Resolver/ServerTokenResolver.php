<?php
namespace Clio\Adapter\SymfonyBundles\OAuth2ServerBundle\Token\Resolver;

use Clio\Adapter\SymfonyBundles\OAuth2ServerBundle\Token\Resolver;

use Symfony\Component\HttpFoundation\Request;
/**
 * ServerTokenResolver 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ServerTokenResolver implements Resolver
{
	private $serverService;

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
			throw new \Exception('Server is not initialized yet.');
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
    public function setServerService($serverService)
    {
        $this->serverService = $serverService;
        return $this;
    }
}

