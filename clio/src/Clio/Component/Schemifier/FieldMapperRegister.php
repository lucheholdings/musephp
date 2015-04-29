<?php
namespace Clio\Component\Schemifier;

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
	 * @return Clio\Component\ArrayTool\Mapper
	 */
	function getMapper();
}

