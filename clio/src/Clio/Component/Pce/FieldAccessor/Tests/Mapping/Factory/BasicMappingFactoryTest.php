<?php
namespace Clio\Component\Pce\FieldAccessor\Tests\Mapping\Factory;

use Clio\Component\Pce\FieldAccessor\Tests\Models;
use Clio\Component\Pce\FieldAccessor\Mapping\Factory\BasicMappingFactory;

/**
 * BasicMappingFactoryTest 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class BasicMappingFactoryTest extends \PHPUnit_Framework_TestCase 
{
	public function testSuccess()
	{
		$model = new Models\TestModel01();
		$factory = $this->getFactory();

		$classMapping = $factory->createClassMapping(new \ReflectionClass($model));
		$fieldMappings = $classMapping->getFields();
		
		$this->assertCount(2, $fieldMappings);

		$this->assertArrayHasKey('privateField', $fieldMappings);
		$this->assertArrayHasKey('publicField', $fieldMappings);

		// 
		$this->assertEquals('public_property', $fieldMappings['publicField']->getAccessType());

		// 
		$this->assertEquals('method', $fieldMappings['privateField']->getAccessType());
		$this->assertEquals('getPrivateField', $fieldMappings['privateField']->getGetterMethod());
		$this->assertEquals('setPrivateField', $fieldMappings['privateField']->getSetterMethod());

	}

	private $factory;

	protected function getFactory()
	{
		if(!$this->factory) {
			$this->factory = new BasicMappingFactory();
		}
		return $this->factory;
	}
}

