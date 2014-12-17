<?php
namespace Clio\Component\Tool\Normalizer\Type;

class NullType extends AbstractType  
{
	public function getName()
	{
		return 'null';
	}

	public function __toString()
	{
		return $this->getName();
	}
}

