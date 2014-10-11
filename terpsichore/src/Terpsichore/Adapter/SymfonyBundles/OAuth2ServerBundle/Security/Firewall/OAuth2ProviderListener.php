<?php
namespace Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Security\Firewall;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\Security\Core\Authentication\Provider\AuthenticationProviderInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Security\Http\Firewall\ListenerInterface;

use Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Security\Authentication\Token\OAuth2SecurityToken;
use Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Token\Resolver as TokenResolver;

use Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Model\TokenInterface as ServerToken;


/**
 * OAuth2ProviderListener 
 * 
 * @uses ListenerInterface
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class OAuth2ProviderListener implements ListenerInterface
{
    /**
     * @var \Symfony\Component\Security\Core\SecurityContextInterface
     */
    protected $securityContext;

	/**
	 * authenticationProvider 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $authenticationProvider;

    /**
     * tokenResolver 
     * 
     * @var mixed
     * @access protected
     */
    protected $tokenResolver;

    /**
     * @param \Symfony\Component\Security\Core\SecurityContextInterface $securityContext The security context.
     * @param \Symfony\Component\Security\Core\Authentication\AuthenticationProvider $authenticationProvider The authentication manager.
     * @param Token\Resolver $tokenResolver
     */
    public function __construct(SecurityContextInterface $securityContext, AuthenticationProviderInterface $authenticationProvider, TokenResolver $tokenResolver = null)
    {
        $this->securityContext = $securityContext;
        $this->authenticationProvider = $authenticationProvider;
        $this->tokenResolver = $tokenResolver;
    }

    /**
     * handle 
     * 
     * @param GetResponseEvent $event 
     * @access public
     * @return void
     */
    public function handle(GetResponseEvent $event)
    {	
		try {
			// Try to resolve ServerToken from Request
			// Get ServerToken from Client or ChainedClientToken
			$token = $this->tokenResolver->resolveToken($event->getRequest());

			if($token && ($token instanceof ServerToken)) {

				if(!$token->getClientId()) {
					throw new AuthenticationException('Client cannot be solved for the requested token, so cannot trust.');
				}
				$securityToken = new OAuth2SecurityToken();
				$securityToken->setServerToken($token);

				// Lets Authenticate the token
				$authenticated = $this->getAuthenticationProvider()->authenticate($securityToken);
				if($authenticated instanceof TokenInterface) {
					return $this->securityContext->setToken($authenticated);
				} else if($authenticated instanceof Response) {
					return $event->setResponse($authenticated);
				}

			} else {
				//throw new \Exception(sprintf('AccessToken is not valid: [%s]', (string)$event->getRequest()->headers ));
				throw new AuthenticationException('Authorization Header is not specified, or invalid');
			}
		} catch (AuthenticationException $e) {
            if (null !== $p = $e->getPrevious()) {
                $event->setResponse($p->getHttpResponse());
				return ;
			}
			throw $e;
		}
    }
    
    /**
     * Get authenticationProvider.
     *
     * @access public
     * @return authenticationProvider
     */
    public function getAuthenticationProvider()
    {
        return $this->authenticationProvider;
    }
    
    /**
     * Set authenticationProvider.
     *
     * @access public
     * @param authenticationProvider the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setAuthenticationProvider($authenticationProvider)
    {
        $this->authenticationProvider = $authenticationProvider;
        return $this;
    }
}
