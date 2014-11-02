<?php
namespace Clio\Component\Util\Container\Stack;

/**
 * Stack 
 *   LIFO implementation 
 *
 * @uses AbstractContainer
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class Stack extends AbstractContainer 
{
	public function push($value)
	{
		$this->getStorage()->insertEnd($value);
	}

	public function pop()
	{
		return $this->getStorage()->removeEnd();
	}

	public function top()
	{
		return $this->storage->end();
	}

	public function bottom()
	{
		return $this->storage->begin();
	}

	public function getIterator()
	{
		return $this->storage->getIterator(LIFO);
	}

	public function setStorage(Storage $storage)
	{
		if(!$storage instanceof SequencialAccessable) {
			throw new \InvalidArgumentException('Storage has to be an SequencialAccessable.');	
		}
		parent::setStorage($storage);
	}
}

