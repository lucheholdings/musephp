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
	 * getDestination 
	 * 
	 * @access public
	 * @return string
	 */
	function getDestination();

	/**
	 * getMapper 
	 * 
	 * @access public
	 * @return Clio\Component\Tool\ArrayTool\Mapper
	 */
	function getMapper();
}

