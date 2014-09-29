<?php
namespace Terpsichore\Bundle\OAuth2ServerBundle\Model;

use Terpsichore\Bundle\OAuth2ServerBundle\Storage\Strategy\UserProviderStrategy; 
/**
 * UserProvider 
 * 
 * @uses UserProviderInterface
 * @abstract
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class UserProvider implements UserProviderStrategy
{
	/**
	 * {@inheritdoc}
	 */
	public function loadUserById($id)
	{
		return null;
	}
}

