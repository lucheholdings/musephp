<?php
namespace Calliope\Core\Connection\Paging;

/**
 * ConnectionFetchPagerInterface 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface ConnectionFetchPagerInterface 
{
	/**
	 * getConnection 
	 * 
	 * @access public
	 * @return void
	 */
	function getConnection();

	/**
	 * getPage 
	 * 
	 * @param mixed $page 
	 * @access public
	 * @return void
	 */
	function getPage($page);

	/**
	 * getPages 
	 * 
	 * @access public
	 * @return void
	 */
	function getPages();

	/**
	 * getTotal 
	 * 
	 * @access public
	 * @return void
	 */
	function getTotal();

	/**
	 * getCriteria 
	 * 
	 * @access public
	 * @return void
	 */
	function getCriteria();

	/**
	 * getOrderBy 
	 * 
	 * @access public
	 * @return void
	 */
	function getOrderBy();

	/**
	 * getPageSize 
	 * 
	 * @access public
	 * @return void
	 */
	function getPageSize();
}

