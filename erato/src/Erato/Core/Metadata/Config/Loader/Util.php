<?php
namespace Clio\Extra\Metadata\Config;

/**
 * Util 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class Util 
{
	/**
	 * merge 
	 *   Merge two configurations
	 * @param mixed $first 
	 * @param mixed $second 
	 * @access public
	 * @return void
	 */
	public function merge($first, $second)
	{
		if(!is_array($first)) {
			return $second;
		}

		foreach($second as $key => $value) {
			if(!isset($first[$key])) {
				$first[$key] = $value;
			} else if(is_scalar($first[$key])) {
				$first[$key] = $value;
			} else if(is_scalar($value)) {
				$first[$key] = $value;
			} else {
				$first[$key] = $this->merge($first[$key], $value);
			}
		}
		
		return $first;
	}
}

