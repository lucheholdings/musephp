<?php
namespace Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Model;

use Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Storage\Strategy\ClientProviderStrategy;
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
	 * @access public
	 * @return void
	 */
	function createClient();

	/**
	 * getClientByName 
	 * 
	 * @param mixed $name 
	 * @access public
	 * @return void
	 */
	function getClientByName($name);

	/**
	 * save 
	 *   Save the model into the specified storage
	 * 
	 * @param Client $client 
	 * @access public
	 * @return void
	 */
	function save(ClientInterface $client);
}

