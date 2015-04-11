<?php
namespace Calliope\Adapter\SymfonyBundles\FrameworkBundle;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Calliope\Framework\Core\SchemaManagerInterface;
// todo: SchemaManagerInteface is not difined.

class AliasedSchemaManagerRegistry extends SchemaManagerRegistry
{
	public function getSchemaManagerByAlias($alias)
	{
		return $this->get($alias);
	}

	public function getSchemaManager($class)
	{
		return $this->getRegistry()->getSchemaManager($class);
	}

	public function addSchemaManager(SchemaManagerInterface $manager, $alias = null)
	{
		$this->getRegistry()->addSchemaManager($manager);
		if($alias) {
			$this->setAlias($alias, $manager->getClassMetadata()->getName());
		}
		return $this;
	}
}


