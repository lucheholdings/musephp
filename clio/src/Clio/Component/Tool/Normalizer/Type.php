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
	const TYPE_NULL    = 'null';
	const TYPE_INT     = 'int';
	const TYPE_INTEGER = 'integer';
	const TYPE_STRING  = 'string';
	const TYPE_FLOAT   = 'float';
	const TYPE_DOUBLE  = 'double';
	const TYPE_BOOL    = 'bool';
	const TYPE_BOOLEAN = 'boolean';
	const TYPE_ARRAY   = 'array';
	const TYPE_IGNORE  = 'ignore';
	const TYPE_MIXED   = 'mixed';
	const TYPE_CHAR    = 'char';

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
}

