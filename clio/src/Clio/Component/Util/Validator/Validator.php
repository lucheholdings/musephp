<?php
namespace Clio\Component\Util\Validator;

/**
 * Validator 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface Validator
{
	/**
	 * validate 
	 * 
	 * @param mixed $object 
	 * @access public
	 * @return void
	 */
	function validate($data);
}

