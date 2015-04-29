<?php
namespace Clio\Component\Metadata\Tests;

use Clio\Component\Metadata\Mapping\AbstractMapping;

class DummyMapping extends AbstractMapping 
{
	public function getName()
	{
		return 'dummy';
	}
}

