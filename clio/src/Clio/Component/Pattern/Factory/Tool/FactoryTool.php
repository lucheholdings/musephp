<?php
namespace Clio\Component\Pattern\Factory\Tool;

/**
 * FactoryTool 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class FactoryTool
{
	/**
	 * shiftArg 
	 *   $arg = FactoryTool::shiftArg($args, 'alias', $default) 
	 * 
	 * @param array $args 
	 * @param mixed $aliasKey 
	 * @param mixed $default 
	 * @access public
	 * @return void
	 */
	static public function shiftArg(array &$args, $aliasKey = null, $default = null) 
	{
		// we try to use the aliasKey to grab the arg, iff aliasKey is specified
		if($aliasKey && array_key_exists($aliasKey, $args)) {
			$arg = $args[$aliasKey];
			unset($args[$aliasKey]);
		} else if(0 < count($args)) {
			// just shift arg
			$arg = array_shift($args);
		} else {
			$arg = $default;
		}

		return $arg;
	}
}

