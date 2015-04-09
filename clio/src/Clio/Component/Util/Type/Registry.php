<?php
namespace Clio\Component\Util\Type;

/**
 * Registry 
 *   Interface of Registry to manage Type object. 
 *   Use ActualTypeRegistry to manage actual type. 
 *    
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
interface Registry
{
	/**
	 * getType 
	 * 
	 * @param mixed $type 
	 * @access public
	 * @return Type 
	 */
	function getType($type);

	/**
	 * hasType 
	 * 
	 * @param mixed $type 
	 * @access public
	 * @return boolean 
	 */
	function hasType($type);

	/**
	 * addType 
	 * 
	 * @param Type $type 
	 * @access public
	 * @return void
	 */
	function addType(Type $type);

	/**
	 * removeType 
	 * 
	 * @param mixed $type 
	 * @access public
	 * @return void 
	 */
	function removeType($type);

}

