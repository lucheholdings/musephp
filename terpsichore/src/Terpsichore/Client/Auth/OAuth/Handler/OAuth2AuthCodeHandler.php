<?php
namespace Terpsichore\Client\Auth\OAuth\Handler;

use Terpsichore\Client\Service;
use Terpsichore\Client\Handler\AbstractHandler;
use Terpsichore\Client\Auth\OAuth\GenericOAuth2Provider;
use Terpsichore\Client\Auth\OAuth\Token\OAuth2AuthCode;
use Terpsichore\Core\Request,
	Terpsichore\Core\Request\HttpRequest;

/**
 * OAuth2AuthCodeHandler 
 * 
 * @uses AbstarctHandler
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class OAuth2AuthCodeHandler extends AbstractHandler 
{
	private $token;

	public function __construct(GenericOAuth2Provider $provider, OAuth2AuthCode $token, array $params = array())
	{
		$this->token = $token;
		parent::__construct($provider, $params);
	}

	public function handleRequest(Request $request)
	{
		if(!$request instanceof HttpRequest) {
			throw new \Exception('OAuth2AuthCodeHandler requires HttpRequest to handle');
		}

		if(!$request->getBody()->has('code')) {
			// Goto AuthProvider LoginForm
			$this->redirectToEntryPoint();
		}

		// Build PreAutehnticateToken from the Redirected RequestURI 
		$token = $this->buildTokenFromRequest($request, $this->token);

		// Activate the tokenthe token
		return $this->getService()->authCode($token);
	}

	public function handle($request)
	{
		return $this->handleRequest($request);
	}

	protected function redirectToEntryPoint()
	{
		header(sprintf(
			'Location: %s?%s', 
			$this->getParameter('entry_point'), 
			http_build_query(array_merge(
				$this->getParameter('query'), 
				array('client_id' => $this->token->get('client_id'))
			))
		)); 
		exit;
	}

	protected function buildTokenFromRequest($request, OAuth2AuthCode $token)
	{
		foreach($request->getBody()->all() as $key => $value) {
			$token->set($key, $value);
		}

		return $token;
	}

	public function setService(Service $service)
	{
		if(!$srevice instanceof GenericOAuth2Provider) {
			throw new \InvalidArgumentException('OAuth2AuthCodeHandler only accept GenericOAuth2Provider as its Service');
		}
		parent::setService($service);
	}
    
    public function getToken()
    {
        return $this->token;
    }
    
    public function setToken($token)
    {
        $this->token = $token;
        return $this;
    }
}

