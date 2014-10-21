<?php
namespace Clio\Component\Tool\Normalizer\Tests;

use Clio\Component\Tool\Normalizer\Context;
use Clio\Component\Tool\Normalizer\Type\PrimitiveType;

class ContextTest extends \PHPUnit_Framework_TestCase 
{
	public function testStack()
	{
		$context = new Context();

		$this->assertInstanceof('SplStack', $context->getStack());
		$this->assertEmpty($context->getStack());
	
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

	public function testTypeRegistry()
	{
		$context = new Context();
		$this->assertInstanceof('Clio\Component\Tool\Normalizer\TypeRegistry', $context->getTypeRegistry());
	}

	public function testScope()
	{
		$context = new Context();
		
		// pre-condition
		$this->assertEmpty($context->getStack());

		$context->enterScope('data', new PrimitiveType('int'));
		// check post entered condition
		$this->assertNotEmpty($context->getStack());
		$this->assertCount(1, $context->getStack());
		$this->assertEquals('data', $context->getStack()->top()->getData()); 

		$context->leaveScope();
		// check post leave condition
		$this->assertEmpty($context->getStack());
	}
}

