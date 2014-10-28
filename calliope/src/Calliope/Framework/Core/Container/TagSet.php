<?php
namespace Calliope\Framework\Core\Container;

use Clio\Component\Util\Container\Set\OnMemorySet;
use Clio\Component\Util\Tag\TagContainer;

use Clio\Component\Util\Validator\ClassValidator;
/**
 * TagSet 
 *   Value  validation 
 * @uses ObjectMap
 * @uses TagContainer
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class TagSet extends OnMemorySet implements TagContainer
{
	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct()
	{
		$this->validator = new ClassValidator('Clio\Component\Util\Tag\Tag');
	}

	/**
	 * containsName 
	 * 
	 * @param mixed $name 
	 * @access public
	 * @return void
	 */
	public function containsName($name)
	{
		foreach($this as $tag) {
			if($name == (string)$tag) {
				return true;
			}
		}

		return false;
	}
}

