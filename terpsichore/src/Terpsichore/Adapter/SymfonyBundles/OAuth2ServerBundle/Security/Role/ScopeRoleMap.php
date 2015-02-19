<?php
namespace Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Security\Role;

use Clio\Component\Util\Container\Map\SimpleMap;

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

