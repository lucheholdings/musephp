<?php
namespace Clio\Component\Validator;

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
