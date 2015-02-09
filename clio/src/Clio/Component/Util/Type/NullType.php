<?php
namespace Clio\Component\Util\Type;

class NullType extends AbstractType 
{
	public function __construct()
	{
		parent::__construct(PrimitiveTypes::TYPE_NULL);
	}

	public function isType($type)
	{
		return 'null' == $type;
	}

	public function isValidData($value)
	{
		return true;
	}
}

