<?php
namespace Clio\Component\Tool\Normalizer;

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
	 * __toString 
	 * 
	 * @access protected
	 * @return void
	 */
	function __toString();

	/**
	 * getFieldType 
	 * 
	 * @param mixed $field 
	 * @param Context $context 
	 * @access public
	 * @return void
	 */
	function getFieldType($field, Context $context);

	/**
	 * isValidData 
	 * 
	 * @param mixed $data 
	 * @access public
	 * @return void
	 */
	function isValidData($data);
}

