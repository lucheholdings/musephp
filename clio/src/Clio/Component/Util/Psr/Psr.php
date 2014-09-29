<?php
namespace Clio\Component\Util\Psr;

/**
 * Psr 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class Psr 
{
	/**
	 * className 
	 *   Convert to PascalCase 
	 * @param mixed $name 
	 * @static
	 * @access public
	 * @return void
	 */
	static public function className($name)
	{
		return trim(preg_replace_callback(
				'/_+(\w)/i', 
				function($matches){
					return ucfirst($matches[1]);
				}, $word), 
			'_');
	}

	/**
	 * methodName 
	 *   Convert to camelCase  
	 * @param mixed $name 
	 * @static
	 * @access public
	 * @return void
	 */
	static public function methodName($name)
	{
		$acceptChars = 'a-zA-Z0-9';

		$splits = preg_split('/[^'. $acceptChars . ']+/', $name, -1, PREG_SPLIT_NO_EMPTY);

		foreach($splits as &$split) {
			$split = ucfirst($split);
		}

		return lcfirst(implode('', $splits));
	}
}

