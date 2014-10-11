<?php
namespace Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Storage\Strategy\Factory;

/**
 * TokenManagerFactory 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface TokenManagerFactory
{
	/**
	 * createTokenManager 
	 * 
	 * @param mixed $connectTo 
	 * @param array $options 
	 * @access public
	 * @return void
	 */
	function createTokenManager($connectTo, array $options = array());
}

