<?php
namespace Calliope\Adapter\SymfonyBundles\FrameworkBundle\Filter;

use Calliope\Framework\Extension\Filter\PropertyFilter;

use Symfony\Component\Security\Core\SecurityContext;

class ActiveUserFilter extends PropertyFilter 
{
	private $context;

	public function __construct($field, SecurityContext $context)
	{
		$this->context = $context;

		parent::__construct($field, null);
	}

	public function getValue()
	{
		$user = $this->context->getUser();
		if(!$user) {
			throw new \Exception('unauthorized for filter');
		}

		return $user->getId();
	}

	public function setValue($value)
	{
		throw new \RuntimeException('ActiveUserFilter is not accepted to call setValue.');
	}
}

