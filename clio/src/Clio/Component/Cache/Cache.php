<?php
namespace Clio\Component\Cache;

/**
 * Cache 
 *   $cache = new XxxCache();
 *   $cache->save($data); 
 *   $data = $cache->load(); 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
interface Cache
{
	/**
	 * getName 
	 * 
	 * @access public
	 * @return void
	 */
	function getName();

	/**
	 * setName 
	 * 
	 * @param mixed $name 
	 * @access public
	 * @return void
	 */
	function setName($name);

	/**
	 * save 
	 * 
	 * @param int $ttl 
	 * @access public
	 * @return void
	 */
	function save($ttl = 0);

	/**
	 * load 
	 * 
	 * @access public
	 * @return void
	 */
	function load();

	/**
	 * isExists 
	 * 
	 * @access public
	 * @return void
	 */
	function isExists();

	/**
	 * delete 
	 * 
	 * @access public
	 * @return void
	 */
	function delete();

	/**
	 * getData 
	 * 
	 * @access public
	 * @return void
	 */
	function getData();

	/**
	 * setData 
	 * 
	 * @param mixed $data 
	 * @access public
	 * @return void
	 */
	function setData($data);

	/**
	 * isCached 
	 * 
	 * @access public
	 * @return void
	 */
	function isCached();
}

