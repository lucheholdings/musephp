<?php
namespace Clio\Component\Util\Type;

interface Resolver
{
	/**
	 * resolve 
	 * 
	 * @param mixed $type 
	 * @param array $options 
	 * @access public
	 * @return void
	 */
	function resolve($type, array $options = array());
}

