<?php
namespace Clio\Extra\Schemifier\Tests;

use Clio\Extra\Schemifier\NormalizerSchemifier;
use Clio\Extra\Schemifier\Tests\Models;
use Clio\Component\Tool\Normalizer\Normalizer;
use Clio\Component\Tool\Normalizer\Strategy\PriorityCollection,
	Clio\Component\Tool\Normalizer\Strategy\ArrayAccessStrategy
;
use Clio\Component\Tool\Schemifier\ClassSchema;
use Clio\Component\Tool\ArrayTool\KeyMapper;

/**
 * NormalizerSchemifierTest 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class NormalizerSchemifierTest extends \PHPUnit_Framework_TestCase
{
	public function testSchemifyArray()
	{
		$schemifier = $this->createSchemifier();

		$data = array('foo' => 'Foo', 'bar' => 'Bar');
		$schemified = $schemifier->schemify($data);


		$this->assertInstanceOf($this->getSchemaClass(), $schemified);
		$this->assertEquals('Foo', $schemified->getFoo());
		$this->assertEquals('Bar', $schemified->getBar());
	}

	public function testSchemifyObject()
	{
		$schemifier = $this->createSchemifier();

		$data = new Models\Model02('Foo', 'Bar');
		$schemified = $schemifier->schemify($data);


		$this->assertInstanceOf($this->getSchemaClass(), $schemified);
		$this->assertEquals('Foo', $schemified->getFoo());
		$this->assertEquals('Bar', $schemified->getBar());
	}

	public function testSchemifyWithMap()
	{
		$schemifier = $this->createSchemifier();

		$data = array('hoge' => 'Foo', 'bar' => 'Bar');
		
		// set fieldKeyMapper for 'hoge' -> 'foo'
		$schemified = $schemifier->schemify($data, array('field_key_mapper' => new KeyMapper(array('hoge' => 'foo'), false)));

		$this->assertInstanceOf($this->getSchemaClass(), $schemified);
		$this->assertEquals('Foo', $schemified->getFoo());
		$this->assertEquals('Bar', $schemified->getBar());
	}

	protected function getSchemaClass()
	{
		return 'Clio\Extra\Schemifier\Tests\Models\Model01';
	}

	protected function createSchemifier()
	{
		$schema = new ClassSchema(new \ReflectionClass($this->getSchemaClass()));
		
		$strategies = new PriorityCollection();
		$strategies
			->initDefaultStrategies()
			->addStrategy(new ArrayAccessStrategy())
		;

		$normalizer = new Normalizer($strategies);

		return new NormalizerSchemifier($schema, $normalizer);
	}
}

