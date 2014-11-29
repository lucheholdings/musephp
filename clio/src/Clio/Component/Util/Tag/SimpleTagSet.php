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
	/**
	 * {@inheritdoc}
	 */
	protected function initContainer(array $values)
	{
		$this
			->enableStorageValidation()
			->setValueValidator(new SubclassValidator('Clio\Component\Util\Tag\Tag'))
		;

		parent::initContianer($values);
	}

	/**
	 * {@inheritdoc}
	 */
	public function containsName($name)
	{
		return $this->containsKey($name);
	}

	/**
	 * {@inheritdoc}
	 */
	public function getNameArray()
	{
		return $this->getKeys();
	}
}
