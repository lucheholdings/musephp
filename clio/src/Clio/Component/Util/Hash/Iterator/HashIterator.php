<?php
namespace Clio\Component\Util\Hash\Iterator;

class HashIterator extends \FilterIterator
{
	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct($container)
	{
		if(!($container instanceof \IteratorAggregate) && !($container instanceof \Iterator)) {
			throw new \Clio\Component\Exception\InvalidArgumentException('HashIterator can only be created for Iterator or IteratorAggregate');
		}

		$this->itr = $itr;
	}

	public function key()
	{
		return $this->current()->getHash();
	}

	public function accept()
	{
		return ($this->current() instanceof HashIdentifiable);
	}
}

