<?php
namespace Terpsichore\Bundle\OAuth2ServerBundle\Storage\Strategy;

use Symfony\Component\Security\Core\User\UserProviderInterface as SecurityUserProvider;
/**
 * UserProviderStrategy
 * 
 * @uses BaseUserInterface
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license MIT
 */
interface UserProviderStrategy extends StorageStrategy, SecurityUserProvider
{
	/**
	 * loadUserById 
	 *   Load user by user identification
	 *   Commonly auto-incremented value, but might be hash or some other.
	 * 
	 * @param mixed $id 
	 * @access public
	 * @return void
	 */
	function loadUserById($id);
}

