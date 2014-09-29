<?php
namespace Clio\Component\Util\Container\Iterator;

class ProxyIterator extends \IteratorIterator implements \OuterIterator
{
	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct(\Iterator $innerIterator)
	{
		parent::__construct($innerIterator);
	}

	public function current()
	{
		return $this->getInnerIterator()->current();
	}

}

