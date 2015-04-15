<?php
namespace Clio\Extra\Tests\Schemifier;

use Clio\Extra\Schemifier\NormalizerSchemifier;
use Clio\Extra\Tests\Models;
use Clio\Extra\Normalizer as ExtraNormalizer;
use Clio\Component\Tool\Normalizer\Normalizer;
use Clio\Component\Tool\Normalizer\Strategy\PriorityCollection,
	Clio\Component\Tool\Normalizer\Strategy\ArrayAccessStrategy
;
use Clio\Component\Tool\Schemifier\ClassSchema;
use Clio\Component\Tool\ArrayTool\Mapper;

use Clio\Extra\Tests\TestSchemaRegistry;
use Clio\Extra\Tests\TestAccessorRegistry;

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
    private $schemaRegistry;

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

		$data = new Models\SchemifierTestModel02('Foo', 'Bar');
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
		$schemified = $schemifier->schemify($data, array('field_key_mapper' => new Mapper\MappedKeyMapper(array('hoge' => 'foo'), false)));

		$this->assertInstanceOf($this->getSchemaClass(), $schemified);
		$this->assertEquals('Foo', $schemified->getFoo());
		$this->assertEquals('Bar', $schemified->getBar());
	}

	protected function getSchemaClass()
	{
		return 'Clio\Extra\Tests\Models\SchemifierTestModel01';
	}

	protected function createSchemifier()
	{
        $schema = $this->getSchemaRegistry()->get($this->getSchemaClass());
		$normalizer = new Normalizer(ExtraNormalizer\Strategy\Factory::createDefaultSet(new TestAccessorRegistry()));

		return new NormalizerSchemifier($schema, $normalizer);
	}

    protected function getSchemaRegistry()
    {
        if(!$this->schemaRegistry) {
            $this->schemaRegistry = new TestSchemaRegistry();
        }
        return $this->schemaRegistry;
    }
}

