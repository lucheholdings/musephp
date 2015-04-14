<?php
namespace Clio\Component\Util\Type\Actual;

/**
 * LazyBindProxyType 
 * 
 * @uses Type
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class LazyBindProxyType extends ProxyType 
{
	public function __construct($type)
	{
		$this->type = $type;
	}

	public function getType()
	{
		if(!$this->type instanceof Type) {
			throw new \RuntimeException('Internal type is not resolved');
		}

		return $this->type;
	}

	public function resolve(Resolver $resolver, $data = null)
	{
		if(!$this->type instanceof Type) {
			$this->type = $resolver->resolve($this->type, array('data' => $data));
		}

		if(!$this->isResolved()) {
			// resolve internal types 
			$this->type = $this->type->resolve($resolver, $data);
		}

		return $this;
	}


	public function setType($type)
	{
		$this->type = $type;
	}

	public function isBound()
	{
		return ($this->type instanceof Type);
	}

	public function isResolved()
	{
		if(!$this->isBound()) {
			return false;
		}
		
		return parent::isResolved();
	}

    public function newData()
    {
        return $this->getType()->newData();
    }
}

