<?php
namespace Clio\Component\Util\Container\Queue;

class Queue extends AbstractContainer
{
	public function enqueue($value)
	{
		$this->getStorage()->insertEnd($value);
	}

	public function dequeue()
	{
		return $this->getStorage()->removeBegin();
	}

	public function begin()
	{
		return $this->getStorage()->begin();
	}

	public function end()
	{
		return $this->getStorage()->end();
	}

	public function count()
	{
		return count($this->getStorage());
	}

	public function getIterator()
	{
		return $this->getStorage()->getIterator(IterationMode::MODE_LIFO);
	}

	public function setStorage(Storage $storage)
	{
		if(!$storage instanceof SequencialAccessable) {
			throw new \InvalidArgumentException('Queue requires SequencialAccessable');
		}
		parent::setStorage($storage);
	}

	public function setStorage(Storage $storage)
	{
		if(!$storage instanceof SequencialAccessable) {
			throw new \InvalidArgumentException('Storage has to be an SequencialAccessable.');	
		}
		parent::setStorage($storage);
	}
}

