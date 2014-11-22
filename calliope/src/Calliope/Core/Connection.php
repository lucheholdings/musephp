<?php
namespace Calliope\Core;

/**
 * Connection 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface Connection
{
	/**
	 * getConnectFrom 
	 * 
	 * @access public
	 * @return void
	 */
	function getConnectFrom();

	/**
	 * flush
	 * 
	 * @access public
	 * @return void
	 */
	function flush();

	/**
	 * create
	 * 
	 * @param mixed $model 
	 * @access public
	 * @return void
	 */
	function create($model);

	/**
	 * update
	 * 
	 * @param mixed $model 
	 * @access public
	 * @return void
	 */
	function update($model);

	/**
	 * delete 
	 * 
	 * @param mixed $model 
	 * @access public
	 * @return void
	 */
	function delete($model);

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

