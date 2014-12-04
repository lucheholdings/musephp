<?php
namespace Calliope\Core\Connection;

/**
 * FetchConnection 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
interface FetchConnection
{
	/**
	 * reload 
	 * 
	 * @param mixed $model 
	 * @access public
	 * @return void
	 */
	function reload($model);

	/**
	 * findBy 
	 *   Find models with criteria condition 
	 * @param array $criteria 
	 * @param array $orderBy 
	 * @param mixed $limit 
	 * @param mixed $offset 
	 * @access public
	 * @return void
	 */
	function findBy(array $criteria, array $orderBy = array(), $limit = null, $offset = null);

	/**
	 * findOneBy 
	 *   Find a model with criteria condition 
	 * @param array $criteria 
	 * @access public
	 * @return void
	 */
	function findOneBy(array $criteria, array $orderBy = null);

	/**
	 * countBy 
	 *   Count models with criteria condition
	 * @param array $criteria 
	 * @access public
	 * @return void
	 */
	function countBy(array $criteria);
}

