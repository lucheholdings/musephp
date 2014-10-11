<?php
namespace Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Model;

class ScopeManager  
{
	public function createScope()
	{
	}

	public function findByNames(array $scopes)
	{
		return $this->findBy(array('name' => $scopes));
	}

	public function findOneByName($scope)
	{
		return $this->findOneBy(array('name' => $scope))
	}
}

