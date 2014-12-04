<?php
namespace Calliope\Core\Connection;

/**
 * CRUDConnection 
 * 
 * @uses FetchConnection
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
interface CRUDConnection extends FetchConnection
{
	/**
	 * create
	 *   CRUDConnection::create to create the model 
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
}

