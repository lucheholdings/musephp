<?php
namespace Clio\Adapter\SymfonyBundles\OAuth2ServerBundle\Storage\Strategy\Factory;

/**
 * UserProviderFactory 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface UserProviderFactory
{
	/**
	 * createUserProvider 
	 * 
	 * @param mixed $connectTo 
	 * @param array $options 
	 * @access public
	 * @return void
	 */
	function createUserProvider($connectTo, array $options = array());
}


