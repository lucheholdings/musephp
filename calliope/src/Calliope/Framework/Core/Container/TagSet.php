<?php
namespace Calliope\Framework\Core\Container;

use Clio\Component\Util\Container\Set\Set;
use Clio\Component\Util\Tag\TagSet;

use Clio\Component\Util\Validator\SubclassValidator;
/**
 * TagSet 
 *   Value  validation 
 * @uses ObjectMap
 * @uses TagSet
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class TagSet extends Set implements TagSet
{
	/**
	 * {@inheritdoc}
	 */
	protected function initContainer(array $values)
	{
		parent::initContainer($values);
		$this->enableStorageValidation();
		$this->getStorage()->setValueValidator(new SubclassValidator('Clio\Component\Util\Tag\Tag'));
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

	/**
	 * getNameArray 
	 * 
	 * @access public
	 * @return void
	 */
	public function getNameArray()
	{
		return array_map(function($tag) {
			return $tag->getName();
		}, $this->getValues());
	}
}

