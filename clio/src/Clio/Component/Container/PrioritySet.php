<?php
namespace Clio\Component\Container;

/**
 * PrioritySet 
 * 
 * @uses Set
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
interface PrioritySet extends Set
{
    /**
     * add 
     * 
     * @param mixed $value 
     * @param int $priority 
     * @access public
     * @return void
     */
    function add($value, $priority = 0);
}

