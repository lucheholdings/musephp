<?php
namespace Erato\Core\Tests;

use Clio\Component\Tool\Schemifier\Factory\SchemifierFactory;

class DummySchemifierFactory implements SchemifierFactory 
{
	/**
	 * createSchemifier 
	 * 
	 * @param mixed $class 
	 * @access public
	 * @return void
	 */
	public function createSchemifier($class)
	{
		return new DummySchemifier($class);
	}

}

