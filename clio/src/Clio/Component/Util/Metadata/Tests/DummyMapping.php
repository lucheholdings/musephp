<?php
namespace Clio\Component\Util\Metadata\Tests;

use Clio\Component\Util\Metadata\Mapping\AbstractMapping;

class DummyMapping extends AbstractMapping 
{
	public function getName()
	{
		return 'dummy';
	}
}

