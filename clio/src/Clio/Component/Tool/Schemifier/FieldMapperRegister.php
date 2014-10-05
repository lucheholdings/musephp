<?php
namespace Clio\Component\Tool\Schemifier;

interface FieldMapperRegister
{
	/**
	 * getSource 
	 * 
	 * @access public
	 * @return string
	 */
	function getSource();

	/**
	 * getDistination 
	 * 
	 * @access public
	 * @return string
	 */
	function getDistination();

	/**
	 * getMapper 
	 * 
	 * @access public
	 * @return Clio\Component\Tool\ArrayTool\Mapper
	 */
	function getMapper();
}

