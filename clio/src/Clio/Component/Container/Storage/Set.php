<?php
namespace Clio\Component\Container\Storage;

use Clio\Component\Container\Set as SetInterface;

/**
 * Set 
 * 
 * @uses AbstractContainer
 * @uses SetInterface
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class Set extends AbstractContainer implements SetInterface 
{
	/**
	 * {@inheritdoc}
	 */
	public function getValues()
	{
		return array_values($this->toArray());
	}

	/**
	 * {@inheritdoc}
	 */
	public function add($value)
	{
		$key = $this->getStorage()->insert($value);

		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function has($value)
	{
		return $this->getStorage()->exists($value);
	}

	/**
	 * {@inheritdoc}
	 */
	public function remove($value)
	{
		$this->storage->remove($value);
		return $this;
	}
}

