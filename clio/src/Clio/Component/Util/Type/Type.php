<?php
namespace Clio\Component\Util\Type;

/**
 * Type 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
interface Type
{
	/**
	 * getName 
	 * 
	 * @access public
	 * @return void
	 */
	function getName();

	/**
	 * isValidData 
	 * 
	 * @param mixed $data 
	 * @access public
	 * @return void
	 */
	function isValidData($data);

	/**
	 * isType 
	 * 
	 * @param mixed $type 
	 * @access public
	 * @return bool 
	 */
	function isType($type);

    /**
     * newData 
     * 
     * @access public
     * @return void
     */
    function newData();
}
