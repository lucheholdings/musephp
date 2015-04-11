<?php
namespace Calliope\Bridge\Symfony\Filter;

use Calliope\Core\Filter\FilterDelegator;

class FilterFactory 
{
	private $container;

	private $defaults = array();

	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct($container, array $defaults = array())
	{
		$this->container = $container;

		$this->defaults = $defaults;
	}

	public function createFilterDelegator($filters)
	{
		$collection = new FilterDelegator();

		foreach($this->defaults as $default){
			$collection->attachFilter($default);
		}

		if(is_array($filters)) {
			foreach($filters as $id) {
				$collection->attachFilter($this->createFilter($id));
			}
		} else {
			$collection->attachFilter($this->createFilter($filters));
		}
		return $collection;
	}

	/**
	 * createFilter 
	 * 
	 * @param mixed $filter 
	 * @access public
	 * @return void
	 */
	public function createFilter($filter)
	{
		return $this->getContainer()->get($filter);
	}
    
    /**
     * Get container.
     *
     * @access public
     * @return container
     */
    public function getContainer()
    {
        return $this->container;
    }
    
    /**
     * Set container.
     *
     * @access public
     * @param container the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setContainer($container)
    {
        $this->container = $container;
        return $this;
    }

	public function addDefaultFilter($filter)
	{
		$this->defaults[] = $filter;
	}
}

