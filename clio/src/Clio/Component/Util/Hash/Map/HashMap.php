<?php
namespace Clio\Component\Util\Hash\Map;

use Clio\Component\Util\Container\Map\Map;
use Clio\Component\Util\Hash\HashIdentifiable;

/**
 * HashMap 
 * 
 * @uses Map
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class HashMap extends Map
{
	/**
	 * createFromCollection 
	 * 
	 * @param mixed $collection 
	 * @static
	 * @access public
	 * @return void
	 */
	static public function createFromCollection($collection)
	{
		$map = array();

		foreach($collection as $value) {
			if($value instanceof HashIdentifiable) {
				$map[$value->getHash()] = $value;
			}
		}

		return new self($map);
	}
}

