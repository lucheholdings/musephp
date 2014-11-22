<?php
namespace Terpsichore\Client\Exception;

use Terpsichore\Client\Auth\Provider;
use Terpsichore\Core\Request;

class AuthenticationException extends TransferException 
{
	private $authProvider;

	public function __construct(Provider $authProvider, Request $request, $response = null, $message = '', $code = 0, \Exception $prev = null)
	{
		$this->authProvider = $authProvider;

		parent::__construct($authProvider->getConnection(), $request, $response, $message, $code, $prev);
	}
    
    public function getAuthenticationProvider()
    {
        return $this->authProvider;
    }
    
    public function setAuthenticationProvider($authProvider)
    {
        $this->authProvider = $authProvider;
        return $this;
    }
}

