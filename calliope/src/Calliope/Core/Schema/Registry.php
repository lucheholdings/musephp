<?php
namespace Calliope\Core\Schema;

/**
 * Registry 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
interface Registry 
{
    /**
     * has 
     * 
     * @param mixed $name 
     * @access public
     * @return bool 
     */
    function has($name);

    /**
     * get 
     * 
     * @param mixed $name 
     * @access public
     * @return Calliope\Core\Schema 
     */
    function get($name);
}

