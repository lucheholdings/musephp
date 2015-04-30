<?php
namespace Clio\Component\Container;

/**
 * Queue 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
interface Queue 
{
    /**
     * enqueue 
     * 
     * @access public
     * @return void
     */
    function enqueue($value);

    /**
     * dequeue 
     * 
     * @access public
     * @return void
     */
    function dequeue();

    /**
     * begin 
     * 
     * @access public
     * @return void
     */
    function begin();

    /**
     * end 
     * 
     * @access public
     * @return void
     */
    function end();
}

