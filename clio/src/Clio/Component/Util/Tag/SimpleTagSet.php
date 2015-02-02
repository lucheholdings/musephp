<?php
namespace Clio\Component\Util\Tag;

use Clio\Component\Util\Container\Set\Set;
use Clio\Component\Util\Validator\SubclassValidator;

/**
 * SimpleTagSet 
 * 
 * @uses Set
 * @uses TagSet
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class SimpleTagSet extends Set implements TagSet
{
	private $owner;

	/**
	 * {@inheritdoc}
	 */
	protected function initContainer(array $values)
	{
		$this
			->enableStorageValidation()
			->setValueValidator(new SubclassValidator('Clio\Component\Util\Tag\Tag'))
		;

		parent::initContainer($values);
	}

	public function removeByName($name)
	{
		$targets = $this->filter(function($v) use ($name){
			return $name == $v->getName();
		});

		foreach($targets as $target) {
			$this->remove($target);	
		}
	}

	/**
	 * {@inheritdoc}
	 */
	public function containsName($name)
	{
		return in_array($name, $this->getNameArray());
		//$this->containsKey($name);
	}

	/**
	 * {@inheritdoc}
	 */
	public function getNameArray()
	{
		$names = array();
		foreach($this as $tag) {
			$names[] = $tag->getName();
		}
		return $names;
	}
    
    public function getOwner()
    {
        return $this->owner;
    }
    
    public function setOwner(TagSetAware $owner)
    {
        $this->owner = $owner;
        return $this;
    }
}
