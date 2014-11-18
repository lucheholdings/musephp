<?php
namespace Terpsichore\Client\Auth\OAuth\Handler;

class OAuth2AuthCodeHandler extends AbstarctHandler 
{
	public function __construct(GenericOAuth2Provider $provider, array $params = array())
	{
		$this->authProvider = $provider;

		parent::__construct($params);
	}

	public function handle($request)
	{
		if(!$request instanceof HttpRequest) {
			throw new \Exception('OAuth2AuthCodeHandler requires HttpRequest to handle');
		}
		if(!$request->has('code')) {
			// Goto AuthProvider LoginForm
			$this->redirectToEntryPoint();
		}

		// Build PreAutehnticateToken from the Redirected RequestURI 
		$token = $this->buildTokenFromRequest($request);

		// Activate the tokenthe token
		return $this->getAuthentiationProvider()->authCode($token);
	}

	protected function redirectToEntryPoint()
	{
		header(sprintf(
			'Location: %s?%s', 
			$this->getParameter('entry_point'), 
			http_build_query(array_merge(
				$this->getParameter('query'), 
				array('client_id' => $this->getParameter('client_id'))
			))
		)); 
		exit;
	}

	protected function buildTokenFromRequest($request)
	{
		return new PreAuthenticateToken(array_replace(
			$request->all(),
			array(
				'client_id' => $this->getParameter('client_id'),
				'client_secret' => $this->getParameter('client_secret'),
			)
		));
	}
}

