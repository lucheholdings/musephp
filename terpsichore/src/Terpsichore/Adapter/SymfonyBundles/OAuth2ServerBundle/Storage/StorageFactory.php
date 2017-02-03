<?php
namespace Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Storage;

use Clio\Component\Pattern\Factory\InheritComponentFactory;

class StorageFactory extends InheritComponentFactory 
{
	private $container;

	public function __construct($container, array $defaultClasses = array())
	{
		parent::__construct('Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Storage\StorageInterface');
		$this->container = $container;
		$this->defaultClasses = array_merge(
			array(
				'user_credentials'   => 'Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Storage\UserCredentials',
				'client'             => 'Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Storage\Client',
				'client_credentials' => 'Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Storage\ClientCredentials',
				'access_token'       => 'Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Storage\AccessToken',
				'refresh_token'      => 'Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Storage\RefreshToken',
				'authorization_code' => 'Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Storage\AuthorizationCode',
				'scope'              => 'Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Storage\Scope',
			),
			$defaultClasses
		);
	}

	public function createUserCredentialsStorage(array $options = array())
	{
		$storageClass = $this->getStorageClass('user_credentials', $options);
		$strategy = $this->getStrategy('user_credentials');
		return $this->createStorage($storageClass, array($strategy, $this->getStorageUtil()));
	}

	public function createClientStorage(array $options = array())
	{
		$storageClass = $this->getStorageClass('client', $options);

		$strategy = $this->getStrategy('client');
		return $this->createStorage($storageClass, array($strategy, $this->getStorageUtil()));
	}

	public function createClientCredentialsStorage(array $options = array())
	{
		$storageClass = $this->getStorageClass('client_credentials', $options);

		$strategy = $this->getStrategy('client');
		return $this->createStorage($storageClass, array($strategy, $this->getStorageUtil()));
	}

	public function createAccessTokenStorage(array $options = array())
	{
		$storageClass = $this->getStorageClass('access_token', $options);

		$strategy = $this->getStrategy('access_token');
		return $this->createStorage($storageClass, array($strategy, $this->getStorageUtil()));
	}

	public function createRefreshTokenStorage(array $options = array())
	{
		$storageClass = $this->getStorageClass('refresh_token', $options);

		$strategy = $this->getStrategy('refresh_token');
		return $this->createStorage($storageClass, array($strategy, $this->getStorageUtil()));
	}

	public function createAuthorizationCodeStorage(array $options = array())
	{
		$storageClass = $this->getStorageClass('authorization_code', $options);
		$strategy = $this->getStrategy('authorization_code');

		return $this->createStorage($storageClass, array($strategy, $this->getStorageUtil()));
	}

	protected function getStorageClass($type, array $options)
	{
		if(isset($options['class'])) {
			$class = $options['class'];
		} else {
			$class = $this->defaultClasses[$type];
		}

		if(!class_exists($class)) {
			throw new \RuntimeException(sprintf('Class %s is not exists.', $class));
		}

		return $class;
	}

	protected function createStorage($class, array $args = array()) 
	{
		return $this->createInheritClassArgs($class, $args);
	}

	public function createScopeStorage(array $options = array())
	{
		$storageClass = $this->getStorageClass('scope', $options);
		$clientStrategy = $this->getStrategy('client');
		$scopeStrategy = $this->getStrategy('scope');
		$scopeUtil = $this->getScopeUtil();
		return $this->createStorage($storageClass, array($scopeStrategy, $clientStrategy, $scopeUtil, $options));
	}
    
    public function getContainer()
    {
        return $this->container;
    }
    
    public function setContainer($container)
    {
        $this->container = $container;
        return $this;
    }

	public function getScopeUtil()
	{
		return $this->getContainer()->get('terpsichore_oauth2_server.scope_util');
	}
	public function getStorageUtil()
	{
		return $this->getContainer()->get('terpsichore_oauth2_server.storage_util');
	}

	protected function getStrategy($type)
	{
		return $this->getContainer()->get('terpsichore_oauth2_server.storage_strategy.'.$type);
	}
}

