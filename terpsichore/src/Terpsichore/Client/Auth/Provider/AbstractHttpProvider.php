<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace Terpsichore\Client\Auth\Provider;

use Terpsichore\Client\Auth\Provider;
use Terpsichore\Client\Auth\Request\AuthenticationRequest;
use Terpsichore\Client\Service\Http\HttpSimpleClientService;
use Terpsichore\Client\Auth\Token;
use Terpsichore\Client\Request;

use Terpsichore\Client\Auth\Request\HttpRequestResolver;

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

	/**
	 * createHttpAuthenticationRequest 
	 * 
	 * @param mixed $uri 
	 * @param mixed $method 
	 * @param mixed $body 
	 * @param array $headers 
	 * @access public
	 * @return void
	 */
	public function createHttpAuthenticationRequest($uri, $method, $body = null, array $headers = array())
	{
		return new AuthenticationRequest(parent::createHttpRequest($uri, $method, $body, $headers));
	}

	/**
	 * createHttpRequest 
	 * 
	 * @param mixed $uri 
	 * @param mixed $method 
	 * @param mixed $body 
	 * @param array $headers 
	 * @access public
	 * @return void
	 */
	public function createHttpRequest($uri, $method, $body = null, array $headers = array())
	{
		return new AuthenticationRequest(parent::createHttpRequest($uri, $method, $body, $headers));
	}

	public function getRequestResolver()
	{
		return new HttpRequestResolver();
	}
}

