<?php
namespace Clio\Component\Util\Psr;

/**
 * Psr1 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
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
	static public function formatClassName($name)
	{
		return trim(preg_replace_callback(
				'/_+(\w)/i', 
				function($matches){
					return ucfirst($matches[1]);
				}, $word), 
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
	static public function formatMethodName($name)
	{
		$acceptChars = 'a-zA-Z0-9';

		$splits = preg_split('/[^'. $acceptChars . ']+/', $name, -1, PREG_SPLIT_NO_EMPTY);

		foreach($splits as &$split) {
			$split = ucfirst($split);
		}

		return lcfirst(implode('', $splits));
	}
}

