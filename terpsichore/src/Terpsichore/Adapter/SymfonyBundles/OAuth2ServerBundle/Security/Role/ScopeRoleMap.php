<?php
namespace Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Security\Role;

use Clio\Component\Container\Map\SimpleMap;

/**
 * ScopeRoleMap 
 * 
 * @uses SimpleMap
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class ScopeRoleMap extends SimpleMap 
{
	public function hasScope($scope)
	{
		return $this->has($scope);
	}

	public function getRole($scope)
	{
		return $this->get($scope);
	}
}

