<?php
namespace Clio\Component\Tool\Normalizer\Tests;
use Clio\Component\Tool\Normalizer\TypeRegistry;

class TypeRegistryTest extends \PHPUnit_Framework_TestCase 
{
	public function testCreate()
	{
		$registry = new TypeRegistry();

		$this->assertInstanceof('Clio\Component\Tool\Normalizer\Type\PrimitiveType', $registry->guessType(1));
		$this->assertInstanceof('Clio\Component\Tool\Normalizer\Type\PrimitiveType', $registry->guessType(1.1));
		$this->assertInstanceof('Clio\Component\Tool\Normalizer\Type\PrimitiveType', $registry->guessType('hello'));
		$this->assertInstanceof('Clio\Component\Tool\Normalizer\Type\PrimitiveType', $registry->guessType(true));
		$this->assertInstanceof('Clio\Component\Tool\Normalizer\Type\PrimitiveType', $registry->guessType(null));
	}
}

