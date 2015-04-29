<?php
namespace Clio\Component\Type;

/**
 * Guesser 
 *   Guess type of value
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
interface Guesser
{
    /**
     * guess 
     * 
     * @param mixed $value 
     * @access public
     * @return void
     */
    function guess($value);
}

