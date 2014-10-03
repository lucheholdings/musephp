<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace Terpsichore\Core\Auth\Provider;

use Terpsichore\Core\Auth\Provider;
use Terpsichore\Core\Auth\Request\AuthenticationRequest;
use Terpsichore\Core\Service\Http\HttpSimpleClientService;
use Terpsichore\Core\Auth\Token;
use Terpsichore\Core\Request;

/**
 * AbstractHttpProvider 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class AbstractHttpProvider extends HttpSimpleClientService implements Provider  
{
	/**
	 * {@inheritdoc}
	 * @final
	 */
	final public function authenticate(Token $token)
	{
		if($token->isAuthenticated()) {
			return $token;
		}

		// Authenticate.
		$authenticated = $this->doAuthenticate($token);

		if(!$authenticated instanceof Token) {
			throw new ImplementationException('Invalid response: doAuthenticate() has to return TokenInterface.');
		}

		return $authenticated;
	}

	/**
	 * doAuthenticate 
	 * 
	 * @param Token $token 
	 * @abstract
	 * @access protected
	 * @return void
	 */
	abstract protected function doAuthenticate(Token $token);

	public function createHttpAuthenticationRequest($uri, $method, $body = null, array $headers = array())
	{
		return new AuthenticationRequest(parent::createHttpRequest($uri, $method, $body, $headers));
	}
}

