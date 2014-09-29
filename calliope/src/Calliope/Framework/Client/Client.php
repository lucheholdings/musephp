<?php
namespace Calliope\Framework\Client;

/**
 * Client
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface Client
{
	/**
	 * findBy 
	 * 
	 * @param array $criteria 
	 * @param array $params 
	 * @access public
	 * @return void
	 */
	function findBy(array $criteria, array $params = array());

	/**
	 * findOneBy 
	 * 
	 * @param array $criteria 
	 * @param array $params 
	 * @access public
	 * @return void
	 */
	function findOneBy(array $criteria, array $params = array());

	/**
	 * create 
	 * 
	 * @param mixed $table 
	 * @param mixed $model 
	 * @param array $params 
	 * @access public
	 * @return void
	 */
	function create($model, array $params = array());

	/**
	 * update 
	 * 
	 * @param mixed $table 
	 * @param mixed $model 
	 * @param array $params 
	 * @access public
	 * @return void
	 */
	function update($model, array $params = array());

	/**
	 * delete 
	 * 
	 * @param mixed $model
	 * @param array $params 
	 * @access public
	 * @return void
	 */
	function delete($model, array $params = array());
}
