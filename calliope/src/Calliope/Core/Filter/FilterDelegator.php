<?php
namespace Calliope\Core\Filter;
use Calliope\Core\Filter;

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
	 * filterRequestFlush 
	 * 
	 * @access public
	 * @return void
	 */
	function filterRequestFlush(Request $request, Response $resopnse);

	/**
	 * filterResponseFlush 
	 * 
	 * @access public
	 * @return void
	 */
	function filterResponseFlush(Request $request, Response $resopnse);

	/**
	 * filterRequestCreate 
	 * 
	 * @param mixed $model 
	 * @access public
	 * @return void
	 */
	function filterRequestCreate(Request $request, Response $resopnse);

	/**
	 * filterResponseCreate 
	 * 
	 * @param mixed $model 
	 * @access public
	 * @return void
	 */
	function filterResponseCreate(Request $request, Response $resopnse);

	/**
	 * filterRequestUpdate 
	 * 
	 * @param mixed $model 
	 * @access public
	 * @return void
	 */
	function filterRequestUpdate(Request $request, Response $resopnse);

	/**
	 * filterResponseUpdate 
	 * 
	 * @param mixed $model 
	 * @access public
	 * @return void
	 */
	function filterResponseUpdate(Request $request, Response $resopnse);
	
	/**
	 * filterRequestDelete 
	 * 
	 * @param mixed $model 
	 * @access public
	 * @return void
	 */
	function filterRequestDelete(Request $request, Response $resopnse);

	/**
	 * filterResponseDelete 
	 * 
	 * @param mixed $model 
	 * @access public
	 * @return void
	 */
	function filterResponseDelete(Request $request, Response $resopnse);

	/**
	 * filterRequestReload 
	 * 
	 * @param mixed $model 
	 * @access public
	 * @return void
	 */
	function filterRequestReload(Request $request, Response $resopnse);

	/**
	 * filterResponseReload 
	 * 
	 * @param mixed $model 
	 * @access public
	 * @return void
	 */
	function filterResponseReload(Request $request, Response $resopnse);

	/**
	 * filterRequestFindBy 
	 * 
	 * @param array $criteria 
	 * @param array $orderBy 
	 * @param mixed $limit 
	 * @param mixed $offset 
	 * @access public
	 * @return void
	 */
	function filterRequestFindBy(Request $request, Response $resopnse);

	/**
	 * filterResponseFindBy 
	 * 
	 * @param mixed $result 
	 * @param array $criteria 
	 * @param array $orderBy 
	 * @param mixed $limit 
	 * @param mixed $offset 
	 * @access public
	 * @return void
	 */
	function filterResponseFindBy(Request $request, Response $resopnse);

	/**
	 * filterRequestFindOneBy 
	 * 
	 * @param array $criteria 
	 * @param array $orderBy 
	 * @access public
	 * @return void
	 */
	function filterRequestFindOneBy(Request $request, Response $resopnse);

	/**
	 * filterResponseFindOneBy 
	 * 
	 * @param mixed $result 
	 * @param array $criteria 
	 * @param array $orderBy 
	 * @access public
	 * @return void
	 */
	function filterResponseFindOneBy(Request $request, Response $resopnse);

	/**
	 * filterRequestCountBy 
	 * 
	 * @param array $criteria 
	 * @access public
	 * @return void
	 */
	function filterRequestCountBy(Request $request, Response $resopnse);

	/**
	 * filterResponseCountBy 
	 * 
	 * @param mixed $result 
	 * @param array $criteria 
	 * @access public
	 * @return void
	 */
	function filterResponseCountBy(Request $request, Response $resopnse);

	/**
	 * attachFilter 
	 * 
	 * @param mixed $filter 
	 * @access public
	 * @return void
	 */
	function attachFilter(Filter $filetr);

	/**
	 * detachFilter 
	 * 
	 * @param mixed $filter 
	 * @access public
	 * @return void
	 */
	function detachFilter(Filter $filter);
}

