<?php
namespace Clio\Component\Util\Type;

/**
 * FieldContainable 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
interface FieldContainable
{
	/**
	 * getFieldType 
	 * 
	 * @param mixed $field 
	 * @access public
	 * @return FieldType 
	 */
	function getFieldType($field);
}

