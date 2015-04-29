<?php
namespace Clio\Component\Cache;

/**
 * CacheProvider 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
interface CacheProvider
{
    /**
     * save 
     * 
     * @param mixed $id 
     * @param mixed $data 
     * @param int $ttl 
     * @access public
     * @return void
     */
	function save($id, $data, $ttl = 0);

    /**
     * fetch 
     * 
     * @param mixed $id 
     * @access public
     * @return void
     */
	function fetch($id);

    /**
     * contains 
     * 
     * @param mixed $id 
     * @access public
     * @return void
     */
	function contains($id);

    /**
     * delete 
     * 
     * @param mixed $id 
     * @access public
     * @return void
     */
	function delete($id);

    /**
     * flush 
     * 
     * @access public
     * @return void
     */
	function flush();
}

