<?php
namespace Clio\Component\Util\Accessor\Tests\Schema\Factory;

use Clio\Component\Util\Accessor\Tests\Models;
use Clio\Component\Util\Accessor\Schema\Factory\BasicClassAccessorFactory;
use Clio\Component\Util\Accessor\Schema\ClassSchema;

class BasicClassAccessorFactoryTest extends \PHPUnit_Framework_TestCase 
{
	/**
	 * testCreate 
	 * 
	 * @access public
	 * @return void
	 */
	public function testCreate()
	{
		$model = new Models\AccessorTestModel();

		$factory = BasicClassAccessorFactory::createFactory();

		$accessor = $factory->createSchemaAccessor(new ClassSchema(new \ReflectionClass($model)));

		$this->assertInstanceof('Clio\Component\Util\Accessor\Schema\SimpleSchemaAccessor', $accessor);
		$this->assertInstanceof('Clio\Component\Util\Accessor\Field\NamedCollection', $accessor->getFieldAccessors());

		$fieldAccessors = $accessor->getFieldAccessors();

		$this->assertTrue($fieldAccessors->hasFieldAccessor('foo'));
		$this->assertInstanceof('Clio\Component\Util\Accessor\Field\PublicPropertyFieldAccessor', $fieldAccessors->getFieldAccessor('foo'));

		$this->assertTrue($fieldAccessors->hasFieldAccessor('bar'));
		$this->assertInstanceof('Clio\Component\Util\Accessor\Field\MethodFieldAccessor', $fieldAccessors->getFieldAccessor('bar'));

		// check hoge field
		$this->assertTrue($fieldAccessors->hasFieldAccessor('hoge'));
		$this->assertInstanceof('Clio\Component\Util\Accessor\Field\MethodFieldAccessor', $fieldAccessors->getFieldAccessor('hoge'));
	}
}

