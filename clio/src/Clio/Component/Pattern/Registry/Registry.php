<?php
namespace Clio\Component\Pattern\Registry;

/**
 * Registry 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface Registry 
{
    /**
     * has 
     * 
     * @param mixed $key 
     * @access public
     * @return void
     */
    function has($key);

	/**
	 * get 
	 * 
	 * @param mixed $key 
	 * @access public
	 * @return mixed|null 
	 */
	function get($key);

	/**
	 * set
	 * 
	 * @param mixed $key 
	 * @param mixed $entry 
	 * @access public
	 * @return void
	 */
	function set($key, $entry);

	/**
	 * remove 
	 * 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	function remove($key);

	/**
	 * clear 
	 * 
	 * @access public
	 * @return void
	 */
	function clear();

	/**
	 * count 
	 * 
	 * @access public
	 * @return void
	 */
	function count();
}
