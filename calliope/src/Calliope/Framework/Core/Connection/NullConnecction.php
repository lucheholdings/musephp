<?php
namespace Calliope\Framework\Core\Connection;

/**
 * NullConnection 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class NullConnection implements Connection 
{
	/**
	 * create 
	 * 
	 * @param $metadata 
	 * @access public
	 * @return void
	 */
	public function create($model)
	{
		return $model;
	}

	/**
	 * delete 
	 * 
	 * @param $metadata 
	 * @access public
	 * @return void
	 */
	public function delete($model)
	{
		return $model;
	}

	/**
	 * update 
	 * 
	 * @param $metadata 
	 * @access public
	 * @return void
	 */
	public function update($model)
	{
		return $model;
	}

	/**
	 * reload 
	 * 
	 * @param $metadata 
	 * @access public
	 * @return void
	 */
	public function reload($model)
	{
		return $model;
	}

	/**
	 * findBy 
	 * 
	 * @param array $criteria 
	 * @param array $orderBy 
	 * @param mixed $limit 
	 * @param mixed $offset 
	 * @access public
	 * @return void
	 */
	public function findBy(array $criteria, array $orderBy = array(), $limit = null, $offset = null)
	{
		return array();
	}

	/**
	 * findOneBy 
	 * 
	 * @param array $criteria 
	 * @param array $orderBy 
	 * @access public
	 * @return void
	 */
	public function findOneBy(array $criteria, array $orderBy = array())
	{
		return null;
	}

	/**
	 * countBy 
	 * 
	 * @param array $criteria 
	 * @access public
	 * @return void
	 */
	public function countBy(array $criteria) 
	{
		return 0;
	}
}

