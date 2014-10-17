<?php
namespace Clio\Component\Util\Accessor\Tests\Field\Factory;

use Clio\Component\Util\Accessor\Field\Factory\MethodFieldAccessorFactory;
use Clio\Component\Util\Accessor\Tests\Models;

class MethodFieldAccessorFactoryTest extends \PHPUnit_Framework_TestCase 
{
	public function testCreate()
	{
		$factory = $this->createFactory();

		$model = new \ReflectionClass('Clio\Component\Util\Accessor\Tests\Models\AccessorTestModel');

		$fieldAccessor = $factory->createClassFieldAccessor($model, 'foo');

		$this->assertInstanceof('Clio\Component\Util\Accessor\Field\MethodFieldAccessor', $fieldAccessor);
	}

	protected function createFactory()
	{
		return new MethodFieldAccessorFactory();
	}
}

