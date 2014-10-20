<?php
namespace Clio\Component\Pattern\Factory;

interface MappedFactory 
{
	/**
	 * createByKey 
	 * 
	 * @access public
	 * @return void
	 */
	function createByKey();

	/**
	 * createByKeyArgs 
	 * 
	 * @param mixed $key 
	 * @param array $args 
	 * @access public
	 * @return void
	 */
	function createByKeyArgs($key, array $args = array());
}

