<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace Terpsichore\Core\Connection;

abstract class AbstractConnection implements Connection
{
	private $authenticationProvider;

	private $services;

	public function getAuthenticationProvider()
	{
		return $this->authenticationProvider;
	}

	public function setAuthenticationProvider(AuthenticationProvider $provider)
	{
		$this->authenticationProvider = $provider;
		return $this;
	}
}

