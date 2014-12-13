<?php
namespace Clio\Adapter\DoctrineExtensions\Query\Criteria;

interface CriteriaBuilder
{
	/**
	 * setConditions 
	 * 
	 * @param array $conditions 
	 * @access public
	 * @return void
	 */
	function setConditions(array $conditions);

	/**
	 * setOrders 
	 * 
	 * @param array $orders 
	 * @access public
	 * @return void
	 */
	function setOrders(array $orders);

	/**
	 * setLimit 
	 * 
	 * @param mixed $limit 
	 * @access public
	 * @return void
	 */
	function setLimit($limit);

	/**
	 * setOffset 
	 * 
	 * @param mixed $offset 
	 * @access public
	 * @return void
	 */
	function setOffset($offset);

	/**
	 * build 
	 * 
	 * @access public
	 * @return void
	 */
	function build();
}
