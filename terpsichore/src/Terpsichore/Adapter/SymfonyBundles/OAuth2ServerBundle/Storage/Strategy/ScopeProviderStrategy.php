<?php
namespace Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Storage\Strategy;

use Symfony\Component\Security\Core\Scope\ScopeProviderInterface as SecurityScopeProvider;
/**
 * ScopeProviderStrategy
 * 
 * @uses BaseScopeInterface
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license MIT
 */
interface ScopeProviderStrategy extends StorageStrategy
{
	/**
	 * getSupportedScopes 
	 * 
	 * @access public
	 * @return void
	 */
	function getSupportedScopes();

	/**
	 * getDefaultScopes 
	 * 
	 * @access public
	 * @return void
	 */
	function getDefaultScopes();
}

