<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace Calliope\Adapter\SymfonyBundles\FrameworkBundle\Filter;

use Erato\Core\Registry\AliasServiceRegistry;
use Calliope\Framework\Core\FilterRegistryInterface;
use Calliope\Framework\Core\Filter\Filter;

class FilterRegistry extends AliasServiceRegistry implements FilterRegistryInterface 
{
	public function hasFilter($alias)
	{
		return $this->has($alias);
	}

	public function getFilters()
	{
		return $this->getAll();
	}

	public function getFilter($alias)
	{
		$filter = $this->get($alias);

		return $filter;
	}

	public function setFilter($alias, Filter $filter)
	{
		return $this->set($alias, $filter);
	}

	public function removeFilter($alias)
	{
		return $this->removeAlias($alias);
	}
}

