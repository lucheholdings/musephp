<?php
namespace Clio\Component\Util\Type;

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
	 * getType 
	 * 
	 * @param mixed $type 
	 * @access public
	 * @return void
	 */
	function getType($type);

	/**
	 * guessType 
	 * 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	function guessType($value);

	/**
	 * hasType 
	 * 
	 * @param mixed $type 
	 * @access public
	 * @return void
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

