<?php
namespace Erato\Core\Tests;

use Clio\Component\Tool\Schemifier\AbstractSchemifier;

class DummySchemifier extends AbstractSchemifier
{
	public function schemify($data)
	{
		return $this->getSchemeClass()->newInstance();
	}
}

