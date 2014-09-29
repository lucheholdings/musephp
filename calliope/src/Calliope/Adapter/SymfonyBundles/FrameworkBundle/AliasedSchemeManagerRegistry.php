<?php
namespace Calliope\Adapter\SymfonyBundles\FrameworkBundle;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Calliope\Framework\Core\SchemeManagerInterface;

class AliasedSchemeManagerRegistry extends SchemeManagerRegistry
{
	public function getSchemeManagerByAlias($alias)
	{
		return $this->get($alias);
	}

	public function getSchemeManager($class)
	{
		return $this->getRegistry()->getSchemeManager($class);
	}

	public function addSchemeManager(SchemeManagerInterface $manager, $alias = null)
	{
		$this->getRegistry()->addSchemeManager($manager);
		if($alias) {
			$this->setAlias($alias, $manager->getClassMetadata()->getName());
		}
		return $this;
	}
}


