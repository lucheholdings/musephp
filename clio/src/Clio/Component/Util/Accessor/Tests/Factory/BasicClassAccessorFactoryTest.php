<?php
namespace Clio\Component\Util\Accessor\Tests\Factory;

use Clio\Component\Util\Accessor\Tests\Models;
use Clio\Component\Util\Accessor\Factory\BasicClassAccessorFactory;

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

		$factory = BasicClassAccessorFactory::createDefaultFactory();

		$accessor = $factory->createClassAccessor($model);

		$this->assertTrue($accessor->hasFieldAccessor('foo'));
		$this->assertInstanceof('Clio\Component\Util\Accessor\Field\PublicPropertyFieldAccessor', $accessor->getFieldAccessor('foo'));

		$this->assertTrue($accessor->hasFieldAccessor('bar'));
		$this->assertInstanceof('Clio\Component\Util\Accessor\Field\MethodFieldAccessor', $accessor->getFieldAccessor('bar'));

		// check hoge field
		$this->assertTrue($accessor->hasFieldAccessor('hoge'));
		$this->assertInstanceof('Clio\Component\Util\Accessor\Field\MethodFieldAccessor', $accessor->getFieldAccessor('hoge'));
	}
}

