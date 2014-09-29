<?php
namespace Clio\Component\Util\Container\Iterator;

/**
 * IteratorInvokeIterator 
 * 
 * @uses ProxyIterator
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class InvokeIterator extends ProxyIterator 
{
	/**
	 * closure 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $closure;
	
	/**
	 * __construct 
	 * 
	 * @param \Iterator $iterator 
	 * @param \Closure $closure 
	 * @access public
	 * @return void
	 */
	public function __construct(\Iterator $iterator, \Closure $closure)
	{
		parent::__construct($iterator);

		$this->closure = $closure;
	}

	/**
	 * current 
	 * 
	 * @access public
	 * @return void
	 */
	public function current()
	{
		$data = parent::current();

		return $this->closure->__invoke($data);
	}
}


