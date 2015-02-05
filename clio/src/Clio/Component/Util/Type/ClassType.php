<?php
namespace Clio\Component\Util\Type;

class ClassType extends AbstractType 
{
	public function __construct($name)
	{
		$this->reflector = new \ReflectionClass($name);

		parent::__construct($name);
	}

	public function isType($type)
	{
		$type = (string)$type;

		switch($type) {
		case 'class':
			return true;
		default:
			return ($type == $this->getName()) || $this->isExtends($type) || $this->isImplements($type);
		}
	}

	public function isImplements($type)
	{
		return $this->getReflector()->isImplement($type);
	}

	public function isExtends($type)
	{
		return $this->getReflector()->isExtends($type);
	}
}

