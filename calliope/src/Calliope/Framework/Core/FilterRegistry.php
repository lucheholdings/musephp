<?php
namespace Calliope\Framework\Core;

/**
 * FilterRegistry 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class FilterRegistry implements \Countable, \IteratorAggregate
{
	/**
	 * filters 
	 *   
	 * @var mixed
	 * @access protected
	 */
	protected $filters;

	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct()
	{
		$this->filters = array();
	}

	/**
	 * has 
	 * 
	 * @param Filter $filter 
	 * @access public
	 * @return void
	 */
	public function hasFilter($alias)
	{
		return isset($this->filters[$alias]);
	}

	/**
	 * getFilters 
	 * 
	 * @access public
	 * @return void
	 */
	public function getFilters()
	{
		return $this->filters;
	}

	/**
	 * getFilter 
	 * 
	 * @param mixed $alias 
	 * @access public
	 * @return void
	 */
	public function getFilter($alias)
	{
		return $this->filters[$alias];
	}

	/**
	 * setFilter 
	 * 
	 * @access public
	 * @return void
	 */
	public function setFilter($alias, $filter)
	{
		$this->filters[$alias] = $filter;

		return $this;
	}

	/**
	 * removeFilter 
	 * 
	 * @param mixed $alias 
	 * @access public
	 * @return void
	 */
	public function removeFilter($alias)
	{
		$deleted = $this->filters[$alias];
		unset($this->filters[$alias]);

		return $deleted;
	}

	/**
	 * count 
	 * 
	 * @access public
	 * @return void
	 */
	public function count()
	{
		return count($this->filters);
	}

	public function getIterator()
	{
		return new \ArrayIterator($this->getFilters());
	}
}

