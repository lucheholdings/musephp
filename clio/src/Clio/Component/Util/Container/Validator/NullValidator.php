<?php
namespace Clio\Component\Util\Container\Validator;

class NullValidator implements Validator
{
	/**
	 * validate 
	 * 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function validate($value)
	{
		return true;
    }
}
