<?php
namespace Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Storage;

use Clio\Component\Pattern\Factory\InheritComponentFactory;

class StorageFactory extends InheritComponentFactory 
{
	private $container;

	public function __construct($container, array $defaultClasses = array())
	{
		parent::__construct('Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Storage\AbstractStorage');
		$this->container = $container;
		$this->defaultClasses = array_merge(
			array(
				'user_credentials'   => 'Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Storage\UserCredentials',
				'client'             => 'Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Storage\Client',
				'client_credentials' => 'Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Storage\ClientCredentials',
				'access_token'       => 'Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Storage\AccessToken',
				'refresh_token'      => 'Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Storage\RefreshToken',
				'authorization_code' => 'Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Storage\AuthorizationCode',
			),
			$defaultClasses
		);
	}

	public function createUserCredentialsStorage($strategy, array $options = array())
	{
		$storageClass = $this->getStorageClass('user_credentials', $options);

		return $this->createStorage($storageClass, array($strategy, $this->getStorageUtil()));
	}

	public function createClientStorage($strategy, array $options = array())
	{
		$storageClass = $this->getStorageClass('client', $options);

		return $this->createStorage($storageClass, array($strategy, $this->getStorageUtil()));
	}

	public function createClientCredentialsStorage($strategy, array $options = array())
	{
		$storageClass = $this->getStorageClass('client_credentials', $options);

		return $this->createStorage($storageClass, array($strategy, $this->getStorageUtil()));
	}

	public function createAccessTokenStorage($strategy, array $options = array())
	{
		$storageClass = $this->getStorageClass('access_token', $options);

		return $this->createStorage($storageClass, array($strategy, $this->getStorageUtil()));
	}

	public function createRefreshTokenStorage($strategy, array $options = array())
	{
		$storageClass = $this->getStorageClass('refresh_token', $options);

		return $this->createStorage($storageClass, array($strategy, $this->getStorageUtil()));
	}

	public function createAuthorizationCodeStorage($strategy, array $options = array())
	{
		$storageClass = $this->getStorageClass('authorization_code', $options);

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

	public function createScopeStorage($strategy, $options)
	{
		$storageClass = $this->getStorageClass('scope', $options);
		return $this->createStorage($storageClass, array($strategy, $options));
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

	public function getStorageUtil()
	{
		return $this->getContainer()->get('terpsichore_oauth2_server.storage_util');
	}
}

