<?php
namespace Clio\Adapter\SymfonyBundles\OAuth2ServerBundle\Storage;

use Clio\Component\Pce\Construction\InheritComponentFactory;

class StorageFactory extends InheritComponentFactory 
{
	public function __construct($superClass, array $defaultClasses = array())
	{
		parent::__construct($superClass);
		$this->defaultClasses = array_merge(
			array(
				'user_credentials'   => 'Clio\Adapter\SymfonyBundles\OAuth2ServerBundle\Storage\UserCredentials',
				'client'             => 'Clio\Adapter\SymfonyBundles\OAuth2ServerBundle\Storage\Client',
				'client_credentials' => 'Clio\Adapter\SymfonyBundles\OAuth2ServerBundle\Storage\ClientCredentials',
				'access_token'       => 'Clio\Adapter\SymfonyBundles\OAuth2ServerBundle\Storage\AccessToken',
				'refresh_token'      => 'Clio\Adapter\SymfonyBundles\OAuth2ServerBundle\Storage\RefreshToken',
				'authorization_code' => 'Clio\Adapter\SymfonyBundles\OAuth2ServerBundle\Storage\AuthorizationCode',
			),
			$defaultClasses
		);
	}

	public function createUserCredentialsStorage($strategy, $util, array $options = array())
	{
		$storageClass = $this->getStorageClass('user_credentials', $options);

		return $this->createStorage($storageClass, array($strategy, $util));
	}

	public function createClientStorage($strategy, $util, array $options = array())
	{
		$storageClass = $this->getStorageClass('client', $options);

		return $this->createStorage($storageClass, array($strategy, $util));
	}

	public function createClientCredentialsStorage($strategy, $util, array $options = array())
	{
		$storageClass = $this->getStorageClass('client_credentials', $options);

		return $this->createStorage($storageClass, array($strategy, $util));
	}

	public function createAccessTokenStorage($strategy, $util, array $options = array())
	{
		$storageClass = $this->getStorageClass('access_token', $options);

		return $this->createStorage($storageClass, array($strategy, $util));
	}

	public function createRefreshTokenStorage($strategy, $util, array $options = array())
	{
		$storageClass = $this->getStorageClass('refresh_token', $options);

		return $this->createStorage($storageClass, array($strategy, $util));
	}

	public function createAuthorizationCodeStorage($strategy, $util, array $options = array())
	{
		$storageClass = $this->getStorageClass('authorization_code', $options);

		return $this->createStorage($storageClass, array($strategy, $util));
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
}

