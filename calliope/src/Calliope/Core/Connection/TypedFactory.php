<?php
namespace Calliope\Core\Connection;

/**
 * TypedFactory 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
interface TypedFactory 
{
    /**
     * createConnectionFor 
     * 
     * @param mixed $type 
     * @param mixed $connectTo 
     * @param array $options 
     * @access public
     * @return void
     */
    function createConnectionFor($type, $connectTo, array $options = array());
}

