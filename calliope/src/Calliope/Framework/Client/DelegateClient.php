<?php
namespace Calliope\Framework\Client;

/**
 * DelegateClient
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface DelegateClient
{
	/**
	 * findBy 
	 * 
	 * @param array $criteria 
	 * @param array $params 
	 * @access public
	 * @return void
	 */
	function findByOn($table, array $criteria, array $params = array());

	/**
	 * findOneBy 
	 * 
	 * @param array $criteria 
	 * @param array $params 
	 * @access public
	 * @return void
	 */
	function findOneByOn($table, array $criteria, array $params = array())

	/**
	 * create 
	 * 
	 * @param mixed $table 
	 * @param mixed $model 
	 * @param array $params 
	 * @access public
	 * @return void
	 */
	function createOn($table, $model, array $params = array());

	/**
	 * update 
	 * 
	 * @param mixed $table 
	 * @param mixed $model 
	 * @param array $params 
	 * @access public
	 * @return void
	 */
	function updateOn($table, $model, array $params = array());

	/**
	 * delete 
	 * 
	 * @param mixed $model
	 * @param array $params 
	 * @access public
	 * @return void
	 */
	function deleteOn($table, $model, array $params = array());
}
