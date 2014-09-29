<?php
namespace Calliope\Adapter\SymfonyBundles\FrameworkBundle\Filter;

class OwnedByActiveUserFilter extends PropertyFilter 
{
	/**
	 * __construct 
	 * 
	 * @param mixed $field 
	 * @param SecurityContext $securityContext 
	 * @access public
	 * @return void
	 */
	public function __construct($field, SecurityContext $securityContext)
	{
		$user = $securityContext->getToken()->getUser();


		throw new \RuntimeException('User is not active on this connection.');
		parent::__construct($field, $userId);
	}
}

