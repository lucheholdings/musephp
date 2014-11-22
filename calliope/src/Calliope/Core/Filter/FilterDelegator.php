<?php
namespace Calliope\Core\Filter;

/**
 * FilterDelegator 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
interface FilterDelegator
{
	/**
	 * onPreFlush 
	 * 
	 * @access public
	 * @return void
	 */
	function onPreFlush();

	/**
	 * onPostFlush 
	 * 
	 * @access public
	 * @return void
	 */
	function onPostFlush();

	/**
	 * onPreCreate 
	 * 
	 * @param mixed $model 
	 * @access public
	 * @return void
	 */
	function onPreCreate($model);

	/**
	 * onPostCreate 
	 * 
	 * @param mixed $model 
	 * @access public
	 * @return void
	 */
	function onPostCreate($model);

	/**
	 * onPreUpdate 
	 * 
	 * @param mixed $model 
	 * @access public
	 * @return void
	 */
	function onPreUpdate($model);

	/**
	 * onPostUpdate 
	 * 
	 * @param mixed $model 
	 * @access public
	 * @return void
	 */
	function onPostUpdate($model);
	
	/**
	 * onPreDelete 
	 * 
	 * @param mixed $model 
	 * @access public
	 * @return void
	 */
	function onPreDelete($model);

	/**
	 * onPostDelete 
	 * 
	 * @param mixed $model 
	 * @access public
	 * @return void
	 */
	function onPostDelete($model);

	/**
	 * onPreReload 
	 * 
	 * @param mixed $model 
	 * @access public
	 * @return void
	 */
	function onPreReload($model);

	/**
	 * onPostReload 
	 * 
	 * @param mixed $model 
	 * @access public
	 * @return void
	 */
	function onPostReload($model);

	/**
	 * onPreFindBy 
	 * 
	 * @param array $criteria 
	 * @param array $orderBy 
	 * @param mixed $limit 
	 * @param mixed $offset 
	 * @access public
	 * @return void
	 */
	function onPreFindBy(array $criteria, array $orderBy, $limit, $offset);

	/**
	 * onPostFindBy 
	 * 
	 * @param mixed $result 
	 * @param array $criteria 
	 * @param array $orderBy 
	 * @param mixed $limit 
	 * @param mixed $offset 
	 * @access public
	 * @return void
	 */
	function onPostFindBy($result, array $criteria, array $orderBy, $limit, $offset);

	/**
	 * onPreFindOneBy 
	 * 
	 * @param array $criteria 
	 * @param array $orderBy 
	 * @access public
	 * @return void
	 */
	function onPreFindOneBy(array $criteria, array $orderBy);

	/**
	 * onPostFindOneBy 
	 * 
	 * @param mixed $result 
	 * @param array $criteria 
	 * @param array $orderBy 
	 * @access public
	 * @return void
	 */
	function onPostFindOneBy($result, array $criteria, array $orderBy);

	/**
	 * onPreCountBy 
	 * 
	 * @param array $criteria 
	 * @access public
	 * @return void
	 */
	function onPreCountBy(array $criteria);

	/**
	 * onPostCountBy 
	 * 
	 * @param mixed $result 
	 * @param array $criteria 
	 * @access public
	 * @return void
	 */
	function onPostCountBy($result, array $criteria);

	/**
	 * onConnect 
	 * 
	 * @access public
	 * @return void
	 */
	function onConnect();

	/**
	 * attachFilter 
	 * 
	 * @param mixed $filter 
	 * @access public
	 * @return void
	 */
	function attachFilter($filter);

	/**
	 * detachFilter 
	 * 
	 * @param mixed $filter 
	 * @access public
	 * @return void
	 */
	function detachFilter($filter);
}

