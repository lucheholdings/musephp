<?php
namespace Clio\Component\Util\Type;

abstract class InheritType extends AbstractType
{
	public function __construct($name, $parent)
	{
		$this->parent = $parent;
		parent::__construct($name);
	}

	public function isType($type)
	{
		return parent::isType($type) || $parent->isType($type);
	}
}

