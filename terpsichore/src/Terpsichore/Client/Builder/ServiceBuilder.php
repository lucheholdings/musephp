<?php
namespace Terpsichore\Client\Builder;

use Terpsichore\Client\Auth\Token;
use Terpsichore\Client\Service;
use Terpsichore\Client\Service\GenericClientServiceProvider;
use Terpsichore\Client\Auth\Provider\Factory\TypedProviderFactory;

class ServiceBuilder 
{
	private $connection;

	private $services;

	private $providerFactory;

	private $authToken;

	private $authArgs;

	public function build()
	{
		$service = null;

		if(!$this->authType && 1 >= count($this->services)) {
			// SimpleService
			$service = $this->services[0];
			$service->setConnection($this->connection);
		} else {
			$service = new GenericClientServiceProvider($this->connection);
			
			$provider = $this->buildAuthProvider();
			$service->setAuthenticationProvider($provider);

			if($this->authToken) {
				$service->setToken($this->authToken);
			}

			foreach($this->services as $name => $sub) {
				$service->setService($name, $sub);
			}
		}

		return $service;
	}

	public function buildAuthProvider()
	{
		return $this->getProviderFactory()->createProvider($this->authType, $this->authArgs);
	}

	protected function getProviderFactory()
	{
		if(!$this->providerFactory) {
			$this->providerFactory = new TypedProviderFactory();

			$this->providerFactory
				->setTypedClass('oauth1', 'Terpsichore\Client\Auth\OAuth\GenericOAuth1Provider')
				->setTypedClass('oauth2', 'Terpsichore\Client\Auth\OAuth\GenericOAuth2Provider')
			;
		}

		return $this->providerFactory;
	}

	public function setAuthenticationType($type, array $args = array())
	{
		$this->authType = $type;
		$this->authArgs = $args;
		return $this;
	}

	public function setAuthenticationToken(Token $token)
	{
		$this->authToken = $token;
		return $this;
	}

	public function setClient($client)
	{
		$connection = null;
		if(is_string($client)) {
			switch($client) {
			case 'guzzle':
				$connection = new \Terpsichore\Bridge\Guzzle\GuzzleHttpConnection();
				break;
			case 'buzz':
				$connection = new \Terpsichore\Bridge\Buzz\BuzzHttpConnection();
				break;
			default:
				break;
			}
		} else if(is_object($client)) {
			if($client instanceof \GuzzleHttp\Client) {
				$connection = new \Terpsichore\Bridge\Guzzle\GuzzleHttpConnection();
			} else if($client instanceof \Buzz\Client) {
				$connection = new \Terpsichore\Bridge\Buzz\BuzzHttpClient();
			}
		}

		if(!$connection) {
			throw new \InvalidArgumentException('Invalid client is given.');
		}

		$this->connection = $connection;

		return $this;
	}

	public function addService($name, Service $service)
	{
		$this->services[$name] = $service;
		return $this;
	}
}

