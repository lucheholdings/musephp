<?php
namespace Clio\Component\Util\Container\Validator;

interface Validator
{
	/**
	 * validate 
	 * 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	function validate($value);
}
