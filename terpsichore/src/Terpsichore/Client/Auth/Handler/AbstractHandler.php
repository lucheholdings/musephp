<?php
namespace Terpsichore\Client\Auth\Handler;

abstract class AbstarctHandler 
{
	private $authenticationProvider;

	private $params;

	public function __construct(GenericOAuth2Provider $provider, array $params = array())
	{
		$this->authenticationProvider = $provider;
		$this->params = $params;
	}

	abstract public function handle($request);

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
    
    public function getAuthenticationProvider()
    {
        return $this->authenticationProvider;
    }
    
    public function setAuthenticationProvider($authenticationProvider)
    {
        $this->authenticationProvider = $authenticationProvider;
        return $this;
    }
    
    public function getParams()
    {
        return $this->params;
    }
    
    public function setParams($params)
    {
        $this->params = $params;
        return $this;
    }
}

