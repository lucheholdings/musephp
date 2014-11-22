<?php
namespace Clio\Component\Util\Accessor;

/**
 * Schema 
 *   Schema is a roadmap to construct accessors.
 *
 *   To create Schema for class, use
 *     ClassSchema(new \ReflectionClass())
 *   or to create Schema for array, use
 *     ArraySchema($data)
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface Schema
{
	/**
	 * getFields 
	 * 
	 * @access public
	 * @return array<Field> 
	 */
	function getFields();

	/**
	 * isSchemaData 
	 *   Check data is acceptable schema data or not. 
	 *   We only check the type of data.
	 * @param mixed $data 
	 * @access public
	 * @return boolean
	 */
	function isSchemaData($data);
}
