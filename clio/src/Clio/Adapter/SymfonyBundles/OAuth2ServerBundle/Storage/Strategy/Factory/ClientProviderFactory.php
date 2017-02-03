<?php
namespace Clio\Adapter\SymfonyBundles\OAuth2ServerBundle\Storage\Strategy\Factory;

/**
 * ClientProviderFactory 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface ClientProviderFactory
{
	/**
	 * createClientProvider 
	 * 
	 * @param mixed $connectTo 
	 * @param array $options 
	 * @access public
	 * @return void
	 */
	function createClientProvider($connectTo, array $options = array());
}

