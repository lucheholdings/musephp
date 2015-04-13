<?php
namespace Clio\Component\Util\Metadata;

/**
 * SchemaRegistry 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
interface SchemaRegistry
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
     * @return void
     */
    function get($key);
}

