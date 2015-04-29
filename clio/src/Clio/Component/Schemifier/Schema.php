<?php
namespace Clio\Component\Schemifier;

interface Schema
{
	const SCHEMA_TYPE_CLASS     = 'class';

	const SCHEMA_TYPE_STD_CLASS = 'std_class';

	const SCHEMA_TYPE_ARRAY     = 'array';

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
	 * isSchemaType 
	 * 
	 * @param mixed $type 
	 * @access public
	 * @return void
	 */
	function isSchemaType($type);
}
