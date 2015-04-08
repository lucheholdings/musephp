<?php
namespace Clio\Component\Util\Type\Actual;

class MixedType extends AbstractType 
{
	public function __construct()
	{
		parent::__construct(PrimitiveTypes::TYPE_MIXED);
	}

	public function isType($type)
	{
		return 'mixed' == $type;
	}

	public function isValidData($value)
	{
		return true;
	}

	public function resolve(Resolver $resolver, $data = null)
	{
		return $resolver->resolve($this, array('data' => $data));
	}

	public function isResolved()
	{
		return false;
	}
}

