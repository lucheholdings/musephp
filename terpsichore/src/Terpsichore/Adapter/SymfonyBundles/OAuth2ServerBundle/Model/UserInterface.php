<?php
namespace Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Model;

/**
 * UserInterface 
 * 
 * @uses BaseUserInterface
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface UserInterface 
{
	/**
	 * getId 
	 *   Commonly auto-incremented id, but can be some other.
	 *   This id is keeped with access_token, refresh_token.
	 * @access public
	 * @return string
	 */
	function getIdentifier();
}

