<?php
namespace Clio\Component\Tool\Normalizer\Tests\Type\Factory;

use Clio\Component\Tool\Normalizer\Type\Factory\BasicFactory;

class BasicFactoryTest extends \PHPUnit_Framework_TestCase 
{
	public function testCreate()
	{
		$factory = new BasicFactory();

		$this->assertInstanceof('Clio\Component\Tool\Normalizer\Type\PrimitiveType', $factory->createType('int'));
		$this->assertInstanceof('Clio\Component\Tool\Normalizer\Type\PrimitiveType', $factory->createType('integer'));
		$this->assertInstanceof('Clio\Component\Tool\Normalizer\Type\PrimitiveType', $factory->createType('string'));
		$this->assertInstanceof('Clio\Component\Tool\Normalizer\Type\PrimitiveType', $factory->createType('float'));
		$this->assertInstanceof('Clio\Component\Tool\Normalizer\Type\PrimitiveType', $factory->createType('double'));
		$this->assertInstanceof('Clio\Component\Tool\Normalizer\Type\PrimitiveType', $factory->createType('bool'));
		$this->assertInstanceof('Clio\Component\Tool\Normalizer\Type\PrimitiveType', $factory->createType('array'));

		// ObjectType
		$this->assertInstanceof('Clio\Component\Tool\Normalizer\Type\ReflectionClassType', $factory->createType('Clio\Component\Tool\Normalizer\Tests\Models\TestModel'));
	}
}

