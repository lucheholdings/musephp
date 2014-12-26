<?php
namespace Clio\Component\Tool\Normalizer\Type;

use Clio\Component\Tool\Normalizer\Type;
use Clio\Component\Tool\Normalizer\Context;

interface ObjectType extends Type
{
	/**
	 * construct 
	 * 
	 * @access public
	 * @return void
	 */
	function construct();

	/**
	 * getClassReflector 
	 * 
	 * @access public
	 * @return void
	 */
	function getClassReflector();

	/**
	 * getIdentifierFields 
	 * 
	 * @access public
	 * @return void
	 */
	function getIdentifierFields();

	/**
	 * getIdentifierValues 
	 * 
	 * @access public
	 * @return void
	 */
	function getIdentifierValues($data);

	/**
	 * getFieldType 
	 * 
	 * @param mixed $field 
	 * @access public
	 * @return void
	 */
	function getFieldType($field, Context $context);

	/**
	 * getDataPool 
	 * 
	 * @access public
	 * @return void
	 */
	function getDataPool();
}

