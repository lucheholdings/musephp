<?php
namespace Clio\Component\Tool\Normalizer\Tests;

use Clio\Component\Tool\Normalizer\Context;
use Clio\Component\Util\Type as Types;

class ContextTest extends \PHPUnit_Framework_TestCase 
{
	public function testStack()
	{
		$context = new Context();

		$this->assertInstanceof('SplStack', $context->getScopeStack());
		$this->assertEmpty($context->getScopeStack());
	
	}

	public function testOptions()
	{
		$context = new Context();	

		$this->assertEmpty($context->getOptions());
		$this->assertFalse($context->hasOption('foo'));

		// Set 
		$context->setOption('foo', 'Foo');
		$this->assertTrue($context->hasOption('foo'));
		$this->assertNotEmpty($context->getOptions());
		$this->assertEquals('Foo', $context->getOption('foo'));
	}

	public function testTypeResolver()
	{
		$context = new Context();
		$this->assertInstanceof('Clio\Component\Tool\Normalizer\Type\TypeResolver', $context->getTypeResolver());
	}

	public function testScope()
	{
		$context = new Context();
		
		// pre-condition
		$this->assertEmpty($context->getScopeStack());

		$context->enterScope('data', new Types\Actual\ScalarType(Types\PrimitiveTypes::TYPE_INT));
		// check post entered condition
		$this->assertNotEmpty($context->getScopeStack());
		$this->assertCount(1, $context->getScopeStack());
		$this->assertEquals('data', $context->getScopeStack()->top()->getData()); 

		$context->leaveScope();
		// check post leave condition
		$this->assertEmpty($context->getScopeStack());
	}
}

