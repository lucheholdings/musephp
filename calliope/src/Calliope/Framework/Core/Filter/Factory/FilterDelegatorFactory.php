<?php
namespace Calliope\Framework\Core\Filter\Factory;

use Calliope\Framework\Core\FilterRegistryInterface;
use Calliope\Framework\Core\Filter\EventDispatcherFilterDelegator;

class FilterDelegatorFactory 
{
	private $registry;

	private $defaults;

	public function __construct(FilterRegistryInterface $registry, array $defaultFilters = array()) 
	{
		$this->registry = $registry;	
		$this->defaults = $defaultFilters;
	}

	public function createFilterDelegator(array $filters = array())
	{
		$delegator = new EventDispatcherFilterDelegator();

		// Add default Filters
		foreach($this->getDefaultFilters() as $filter) {
			if(is_object($filter)) {
				$delegator->attachFilter($filter);
			} else {
				$delegator->attachFilter($this->getRegistry()->getFilter($filter));
			}
		}

		// Add custom Filters
		foreach($filters as $filter) {
			$delegator->attachFilter($this->getRegistry()->getFilter($filter));
		}

		return $delegator;
	}
    
    public function getRegistry()
    {
        return $this->registry;
    }
    
    public function setRegistry($registry)
    {
        $this->registry = $registry;
        return $this;
    }
    
    public function getDefaultFilters()
    {
        return $this->defaults;
    }
    
    public function setDefaultFilters($defaults)
    {
        $this->defaults = $defaults;
        return $this;
    }

	public function addDefaultFilter($filter)
	{
		$this->defaults[] = $filter;
	}
}

