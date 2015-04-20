<?php
namespace Clio\Component\Util\Literal;

/**
 * Psr1 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class Psr1 
{
	/**
	 * formatClassName 
	 * 
	 * @param mixed $name 
	 * @static
	 * @access public
	 * @return void
	 */
	static public function formatClassName()
	{
		$args = func_get_args();
		$name = implode('_', $args);

		return trim(preg_replace_callback(
				'/_+(\w)/i', 
				function($matches){
					return ucfirst($matches[1]);
				}, $name), 
			'_');
	}

	/**
	 * formatMethodName
	 *   Convert to camelCase  
	 * @param mixed $name 
	 * @static
	 * @access public
	 * @return void
	 */
	static public function formatMethodName()
	{
		$args = func_get_args();
		$name = implode('_', $args);

		$acceptChars = 'a-zA-Z0-9';

		$splits = preg_split('/[^'. $acceptChars . ']+/', $name, -1, PREG_SPLIT_NO_EMPTY);

		foreach($splits as &$split) {
			$split = ucfirst($split);
		}

		return lcfirst(implode('', $splits));
	}
}

