<?php
namespace Clio\Component\Util\Tag;

use Clio\Component\Pattern\Factory\ComponentFactory;

/**
 * TagComponentFactory 
 * 
 * @uses ComponentFactory
 * @uses TagFactory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class TagComponentFactory extends ComponentFactory implements TagFactory 
{
	/**
	 * __construct 
	 * 
	 * @param mixed $tagClass 
	 * @access public
	 * @return void
	 */
	public function __construct($tagClass = null)
	{
		if(!$tagClass) {
			$tagClass = 'Clio\Component\Util\Tag\SimpleTag';
		}
		if(!$tagClass instanceof \ReflectionClass) {
			$tagClass = new \ReflectionClass($tagClass);
		}

		if(!$tagClass->implementsInterface('Clio\Component\Util\Tag\Tag')) {
			throw new \Clio\Component\Exception\InvalidArgumentException(sprintf('Class "%s" is not implement Tag', $tagClass->getName()));
		}
		parent::__construct($tagClass);
	}

	/**
	 * createTag 
	 * 
	 * @param mixed $key 
	 * @param mixed $value 
	 * @param mixed $owner 
	 * @access public
	 * @return void
	 */
	public function createTag($name, $owner = null)
	{
		return $this->doCreate(array($name, $owner));
	}
}

