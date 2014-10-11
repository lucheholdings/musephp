<?php
namespace Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Model;

use Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Storage\Strategy\ScopeProviderStrategy as ScopeProviderInterface;

interface ScopeManagerInterface extends ScopeProviderInterface
{
	/**
	 * createScope 
	 * 
	 * @param mixed $scope 
	 * @param mixed $isDefault 
	 * @access public
	 * @return void
	 */
	function createScope();

	/**
	 * save 
	 * 
	 * @param Scope $scope 
	 * @access public
	 * @return void
	 */
	function save(ScopeInterface $scope);
}

