<?php
namespace Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Model

/**
 * ClientManagerInterface
 * 
 * @uses ClientProviderStrategy
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface ClientManagerInterface extends ClientProviderStrategy
{
	/**
	 * createClient 
	 * 
	 * @param mixed $name 
	 * @param mixed $supportedScopes 
	 * @param mixed $grantTypes 
	 * @param mixed $redirectUris 
	 * @access public
	 * @return void
	 */
	function createClient($name, $supportedScopes, $grantTypes, $redirectUris);

	/**
	 * findClientByName 
	 * 
	 * @param mixed $name 
	 * @access public
	 * @return void
	 */
	function findClientByName($name);

	/**
	 * save 
	 *   Save the model into the specified storage
	 * 
	 * @param Client $client 
	 * @access public
	 * @return void
	 */
	function save(Client $client);
}

