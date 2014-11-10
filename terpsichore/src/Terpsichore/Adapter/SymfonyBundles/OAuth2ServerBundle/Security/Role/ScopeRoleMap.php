<?php
namespace Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Security\Role;

use Clio\Component\Util\Container\Map\Map;

class ScopeRoleMap extends Map 
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

