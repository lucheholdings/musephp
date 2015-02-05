<?php
namespace Clio\Component\Util\Type;

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
}

