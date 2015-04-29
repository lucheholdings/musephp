<?php
namespace Clio\Component\Container\Storage;

use Clio\Component\Container\Storage;

/**
 * SequencialAccessable 
 * 
 * @uses Storage
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
interface SequencialAccessable extends Storage
{
    /**
     * insertBegin 
     * 
     * @param mixed $value 
     * @access public
     * @return void
     */
	function insertBegin($value);

    /**
     * insertEnd 
     * 
     * @param mixed $value 
     * @access public
     * @return void
     */
	function insertEnd($value);

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

    /**
     * removeBegin 
     * 
     * @access public
     * @return void
     */
	function removeBegin();

    /**
     * removeEnd 
     * 
     * @access public
     * @return void
     */
	function removeEnd();
}
