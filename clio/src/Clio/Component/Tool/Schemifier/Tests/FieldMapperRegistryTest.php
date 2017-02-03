<?php
namespace Clio\Component\Tool\Schemifier\Tests;

use Clio\Component\Tool\Schemifier\FieldMapperRegistry;
use Clio\Component\Tool\Schemifier\FieldMapperRegister;
use Clio\Component\Tool\ArrayTool\KeyMapper;

class FieldMapperRegistryTest extends \PHPUnit_Framework_TestCase 
{
	public function testSuccess()
	{
		$registry = new FieldMapperRegistry();

		
		$this->assertFalse($registry->has('Foo', 'Bar'));
		$mapper = new KeyMapper(array('id' => 'code'));

		$registry->set(
			'Foo', 
			'Bar', 
			$mapper
		);

		$this->assertTrue($registry->has('Foo', 'Bar'));

		$this->assertEquals($mapper, $registry->get('Foo', 'Bar'));
	}
}

