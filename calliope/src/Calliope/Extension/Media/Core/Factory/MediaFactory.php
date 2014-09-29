<?php
namespace Calliope\Extension\Media\Core\Factory;

interface MediaFactory
{
	/**
	 * createMedia 
	 * 
	 * @param mixed $name 
	 * @param array $params 
	 * @access public
	 * @return void
	 */
	function createMedia($name, array $options = array());
}

