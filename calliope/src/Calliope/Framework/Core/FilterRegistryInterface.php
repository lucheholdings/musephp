<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace Calliope\Framework\Core;

use Calliope\Framework\Core\Filter\Filter;

interface FilterRegistryInterface
{
	/**
	 * getFilters 
	 * 
	 * @access public
	 * @return void
	 */
	function getFilters();

	/**
	 * hasFilter 
	 * 
	 * @param mixed $id 
	 * @access public
	 * @return void
	 */
	function hasFilter($id);

	/**
	 * getFilter 
	 * 
	 * @param mixed $id 
	 * @access public
	 * @return void
	 */
	function getFilter($id);

	/**
	 * setFilter 
	 * 
	 * @param mixed $id 
	 * @param Filter $filter 
	 * @access public
	 * @return void
	 */
	function setFilter($id, Filter $filter);

	/**
	 * removeFilter 
	 * 
	 * @param mixed $id 
	 * @access public
	 * @return void
	 */
	function removeFilter($id);
}
